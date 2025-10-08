# -----------------------------
# Stage 0: Frontend Build
# -----------------------------
FROM --platform=$TARGETOS/$TARGETARCH mhart/alpine-node:14 AS frontend-build
WORKDIR /app

# Copy only the files needed for frontend build
COPY package.json yarn.lock ./
COPY resources ./resources
COPY public ./public

# Ensure assets folder exists
RUN mkdir -p public/assets \
    && yarn install --frozen-lockfile \
    && yarn run build:production

# -----------------------------
# Stage 1: PHP Backend
# -----------------------------
FROM --platform=$TARGETOS/$TARGETARCH php:8.2-fpm-alpine
WORKDIR /app

# Copy project files
COPY . ./
COPY --from=frontend-build /app/public/assets ./public/assets

# Install system dependencies
RUN apk add --no-cache \
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
    && docker-php-ext-configure zip \
    && docker-php-ext-install bcmath gd pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Setup environment & storage
RUN cp .env.example .env \
    && mkdir -p bootstrap/cache storage/logs storage/framework/{sessions,views,cache} \
    && chmod -R 777 bootstrap storage \
    && composer install --no-dev --optimize-autoloader \
    && rm -rf .env bootstrap/cache/*.php \
    && chown -R nginx:nginx /app/storage

# Setup cron jobs and PHP/Nginx
RUN rm /usr/local/etc/php-fpm.conf \
    && echo "* * * * * /usr/local/bin/php /app/artisan schedule:run >> /dev/null 2>&1" >> /var/spool/cron/crontabs/root \
    && echo "0 23 * * * certbot renew --nginx --quiet" >> /var/spool/cron/crontabs/root \
    && sed -i 's/ssl_session_cache/#ssl_session_cache/' /etc/nginx/nginx.conf \
    && mkdir -p /var/run/php /var/run/nginx

# Copy configuration files
COPY .github/docker/default.conf /etc/nginx/http.d/default.conf
COPY .github/docker/www.conf /usr/local/etc/php-fpm.conf
COPY .github/docker/supervisord.conf /etc/supervisord.conf
COPY .github/docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Expose ports
EXPOSE 80 443

# Entrypoint & command
ENTRYPOINT ["/bin/ash", "/entrypoint.sh"]
CMD ["supervisord", "-n", "-c", "/etc/supervisord.conf"]
