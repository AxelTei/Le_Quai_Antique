web: heroku-php-nginx -C nginx_app.conf public/
release: php bin/console cache:clear && php bin/console cache:warmup && php bin/console doctrine:migrations:migrate
