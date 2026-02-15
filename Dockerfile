FROM php:8.3-cli

RUN apt-get update \
    && apt-get install -y --no-install-recommends ca-certificates \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql

WORKDIR /app
COPY . .

RUN mkdir -p /app/storage \
    && chmod -R 775 /app/storage

EXPOSE 8080
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8080} -t public"]
