ARG PHP_IMAGE=php:7.2-fpm-alpine
FROM ${PHP_IMAGE} as app_vendor
RUN apk add npm
RUN docker-php-ext-install sockets bcmath

# Set the WORKDIR to /app so all following commands run in /app
WORKDIR /app

COPY composer.json composer.lock

# Install Composer and make it available in the PATH
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# Copy composer files into the app directory.
COPY composer.json composer.lock ./

# Install dependencies with Composer.
# --no-interaction makes sure composer can run fully automated
RUN composer install --no-interaction --prefer-dist --no-scripts --no-dev

# We don't need composer with cache inside image
FROM ${PHP_IMAGE}
RUN docker-php-ext-install bcmath sockets

RUN sed -i "s/\(user\|group\) = www-data/\1 = root/" /usr/local/etc/php-fpm.d/www.conf

# Set the WORKDIR to /app so all following commands run in /app
WORKDIR /app
COPY --from=app_vendor /app ./
RUN apk add npm
COPY . ./
COPY .env.example .env
RUN npm install -g grunt-cli
RUN npm install
RUN grunt apidoc

CMD ["php-fpm", "-R"]
