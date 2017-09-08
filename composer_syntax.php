export http_proxy=http://144.144.2.57:3128
export https_proxy=http://144.144.2.57:3128


php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
 
curl -sS https://getcomposer.org/installer | php
curl -sS https://getcomposer.org/installer | php -- --install-dir=bin --filename=composer



php -r "unlink('composer-setup.php');"

composer-setup.php



php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"



composer.phar
php composer
composer -V
php bin/composer
php composer.phar install
 
 
mv composer.phar /usr/local/bin/composer
 

phpinfo()
php -version

composer require monolog/monolog
composer require phpexcel/phpexcel
