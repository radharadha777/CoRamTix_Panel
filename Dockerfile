# Stage 0: Build frontend assets
FROM --platform=$TARGETOS/$TARGETARCH node:20-alpine AS build
WORKDIR /app

# Install build tools
RUN apk add --no-cache python3 g++ make bash curl

# Enable Yarn
RUN corepack enable && corepack prepare yarn@stable --activate

# Copy package files and install dependencies
COPY package.json yarn.lock ./
RUN yarn install --frozen-lockfile

# Copy all source files
COPY . ./

# Ensure public/assets exists
RUN mkdir -p public/assets

# Build frontend assets
RUN yarn run build:production

# Stage 1: Build PHP backend container
FROM --platform=$TARGETOS/$TARGETARCH php:8.2-fpm-alpine
WORKDIR /app

# Copy PHP app files
COPY . ./

# Copy frontend assets from build stage
COPY --from=build /app/public/assets ./public/assets

# Install PHP extensions and system dependencies
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
    bash \
    && docker-php-ext-configure zip \
    && docker-php-ext-install bcmath gd pdo_mysql zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && cp .env.example .env \
    && mkdir -p bootstrap/cache/ storage/logs storage/framework/sessions storage/framework/views storage/framework/cache \
    && chmod -R 777 bootstrap storage \
    && composer install --no-dev --optimize-autoloader \
    && rm -rf bootstrap/cache/*.php \
    && mkdir -p /app/storage/logs/ \
    && chown -R nginx:nginx .

# Setup cron jobs and PHP/NGINX runtime folders
RUN rm /usr/local/etc/php-fpm.conf \
    && echo "* * * * * /usr/local/bin/php /app/artisan schedule:run >> /dev/null 2>&1" >> /var/spool/cron/crontabs/root \
    && echo "0 23 * * * certbot renew --nginx --quiet" >> /var/spool/cron/crontabs/root \
    && sed -i s/ssl_session_cache/#ssl_session_cache/g /etc/nginx/nginx.conf \
    && mkdir -p /var/run/php /var/run/nginx

# Copy config files
COPY .github/docker/default.conf /etc/nginx/http.d/default.conf
COPY .github/docker/www.conf /usr/local/etc/php-fpm.conf
COPY .github/docker/supervisord.conf /etc/supervisord.conf

# Expose ports
EXPOSE 80 443

# Entrypoint & CMD
ENTRYPOINT ["/bin/ash", ".github/docker/entrypoint.sh"]
CMD ["supervisord", "-n", "-c", "/etc/supervisord.conf"]
