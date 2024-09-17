# Step 1: Use the official PHP-FPM image
FROM php:8.1-fpm

# Step 2: Install necessary packages and PHP extensions
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql mysqli

# Step 3: Copy custom Nginx config file into the container
COPY ./nginx.conf /etc/nginx/nginx.conf

# Step 4: Set working directory
WORKDIR /var/www/html

# Step 5: Copy all local files into the container
COPY . /var/www/html

# Step 6: Set proper permissions for the web server to access the files
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Step 7: Expose port 80 for Nginx
EXPOSE 80

# Step 8: Start both Nginx and PHP-FPM
CMD ["sh", "-c", "service php8.1-fpm start && nginx -g 'daemon off;'"]
