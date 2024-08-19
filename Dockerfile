FROM php:8.1-fpm
RUN dnf update -y && dnf install -y \
    epel-release \
    dnf-plugins-core \
    gcc \
    gcc-c++ \
    make \
    libpng-devel \
    libjpeg-devel \
    freetype-devel \
    oniguruma-devel \
    libxml2-devel \
    zip \
    curl \
    unzip \
    git \
    vim \
    npm
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN curl -fsSL https://nodejs.org/dist/v20.15.1/node-v20.15.1-linux-x64.tar.xz | tar -xJf - -C /usr/local --strip-components=1 --no-same-owner \
    && npm install -g npm@latest
WORKDIR /var/www/html
COPY . /var/www/html
RUN composer install
RUN npm install && npm run build
RUN chown -R nginx:nginx /var/www/html/storage /var/www/html/bootstrap/cache
EXPOSE 8082
CMD ["php-fpm"]