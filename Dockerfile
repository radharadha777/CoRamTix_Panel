# =========================
# Stage 0: Build frontend assets
# =========================
FROM --platform=$TARGETOS/$TARGETARCH node:20-alpine AS build
WORKDIR /app

# Install build tools for native modules
RUN apk add --no-cache python3 g++ make bash curl

# Enable latest Yarn
RUN corepack enable && corepack prepare yarn@stable --activate

# Copy package files and install dependencies
COPY package.json yarn.lock ./
RUN yarn install --frozen-lockfile

# Copy project files and build production assets
COPY . ./
RUN yarn run build:production

# =========================
# Stage 1: PHP runtime
# =========================
FROM --platform=$TARGETOS/$TARGETARCH php:8.2-fpm-alpine
WORKDIR /app

# Install PHP extensions & OS packages
RUN apk add --no-cache --update \
        ca-certificates \
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
    && docker-php-ext-install bcmath gd pdo_mysql zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy project files
COPY . ./

# Copy frontend assets from Stage 0
COPY --from=build /app/public/assets ./public/assets

# Copy config files for nginx & PHP-FPM & supervisor
COPY .github/docker/default.conf /etc/nginx/http.d/default.conf
COPY .github/docker/www.conf /usr/local/etc/php-fpm.conf
COPY .github/docker/supervisord.conf /etc/supervisord.conf
COPY .github/docker/entrypoint.sh .github/docker/entrypoint.sh

# Make entrypoint executable
RUN chmod +x .github/docker/entrypoint.sh

# Setup environment & storage
RUN cp .env.example .env \
    && mkdir -p bootstrap/cache/ storage/logs storage/framework/{sessions,views,cache} \
    && chown -R nginx:nginx bootstrap storage \
    && composer install --no-dev --optimize-autoloader \
    && rm -rf .env bootstrap/cache/*.php

# Setup cron jobs
RUN echo "* * * * * /usr/local/bin/php /app/artisan schedule:run >> /dev/null 2>&1" >> /var/spool/cron/crontabs/root \
    && echo "0 23 * * * certbot renew --nginx --quiet" >> /var/spool/cron/crontabs/root

# Fix nginx SSL warning
RUN sed -i s/ssl_session_cache/#ssl_session_cache/g /etc/nginx/nginx.conf \
    && mkdir -p /var/run/php /var/run/nginx

# Expose ports
EXPOSE 80 443

# Entrypoint & command
ENTRYPOINT [ "/bin/ash", ".github/docker/entrypoint.sh" ]
CMD [ "supervisord", "-n", "-c", "/etc/supervisord.conf" ]
