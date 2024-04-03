Docker & docker-compose
Manual module work wiki
.env for docker cp .env-example .env
change TENDER_API_PATH variable in .env to your full path to project

docker-compose build
docker-compose ps
docker-compose up -d


Check http://127.0.0.1:8090
If you need artisan use docker-compose exec php-fpm bash

Installation from script.

Services:

counterparty_api
ru_counterparty_api


Running
Just exec

sudo sh install.sh SERVICE_NAME



sudo sh install.sh counterparty_api
sudo sh install.sh ru_counterparty_api