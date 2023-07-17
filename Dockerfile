FROM sail-8.2/app

# Install mbstring extension
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions \
   && install-php-extensions \
       mbstring