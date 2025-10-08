# Stage 0: Frontend Build Check
FROM --platform=$TARGETOS/$TARGETARCH mhart/alpine-node:14 as frontend-build
WORKDIR /app
COPY . ./

# Check if frontend assets already exist, if not then build
RUN echo "=== Checking Frontend Assets ===" && \
    if ls public/assets/*.js 1> /dev/null 2>&1; then \
        echo "Frontend assets already exist - skipping build" && \
        echo "Found files:" && ls -la public/assets/*.js | head -10; \
    else \
        echo "Building frontend assets..." && \
        yarn install --frozen-lockfile && \
        yarn run build:production && \
        echo "Frontend build completed successfully"; \
    fi

# Stage 1: PHP Backend
FROM --platform=$TARGETOS/$TARGETARCH php:8.2-fpm-alpine
WORKDIR /app

# Copy application code
COPY . ./

# Copy built assets from frontend stage
COPY --from=frontend-build /app/public/assets ./public/assets/

# Install system dependencies
RUN apk add --no-cache --update \
    ca-certificates \
    dcron \
    curl \
    git \
    supervisor \
    tar \
    unzip \
    nginx \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    certbot \
    certbot-nginx \
    netcat-openbsd \
    && docker-php-ext-configure zip \
    && docker-php-ext-install bcmath gd pdo_mysql zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Setup application
RUN mkdir -p /app/var \
    && cp .env.example .env \
    && mkdir -p bootstrap/cache/ storage/logs storage/framework/sessions storage/framework/views storage/framework/cache \
    && chmod 777 -R bootstrap storage \
    && composer install --no-dev --optimize-autoloader \
    && php artisan key:generate \
    && rm -rf .env bootstrap/cache/*.php \
    && mkdir -p /app/storage/logs/ \
    && chown -R nginx:nginx .

# Setup cron jobs
RUN echo "* * * * * /usr/local/bin/php /app/artisan schedule:run >> /dev/null 2>&1" >> /var/spool/cron/crontabs/root \
    && echo "0 23 * * * certbot renew --nginx --quiet" >> /var/spool/cron/crontabs/root

# Configure nginx and php-fpm
RUN sed -i s/ssl_session_cache/#ssl_session_cache/g /etc/nginx/nginx.conf \
    && mkdir -p /var/run/php /var/run/nginx

# Copy configuration files
COPY .github/docker/default.conf /etc/nginx/http.d/default.conf
COPY .github/docker/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY .github/docker/supervisord.conf /etc/supervisord.conf

# Create php-fpm.conf if missing
RUN if [ ! -f "/usr/local/etc/php-fpm.conf" ]; then \
        echo "[global]\ndaemonize = no\n[www]\nlisten = /var/run/php/php8.2-fpm.sock\nlisten.owner = nginx\nlisten.group = nginx\nlisten.mode = 0660" > /usr/local/etc/php-fpm.conf; \
    fi

EXPOSE 80 443

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

ENTRYPOINT [ "/bin/ash", ".github/docker/entrypoint.sh" ]
CMD [ "supervisord", "-n", "-c", "/etc/supervisord.conf" ]
