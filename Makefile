# Alias
DOCKER_DIR = docker
MAIN_CONTAINER = php-app
UID = 1000:1000
DOCKER_EXEC = docker exec -i -u ${UID}
DOCKER_EXEC_INTERACTIVE = docker exec -it -u ${UID}

# Commands
build:
	cd ${DOCKER_DIR} && docker-compose up -d --build

composer-install:
	${DOCKER_EXEC} ${MAIN_CONTAINER} /bin/bash -c "cd app && composer install --no-scripts --no-interaction --optimize-autoloader"

ssh:
	${DOCKER_EXEC_INTERACTIVE} ${MAIN_CONTAINER} /bin/bash

migrate:
	${DOCKER_EXEC} ${MAIN_CONTAINER} /bin/bash -c "cd app && bin/console doctrine:migrations:migrate"

install:
	make build
	make composer-install
	make migrate

check-standards:
	${DOCKER_EXEC} ${MAIN_CONTAINER} /bin/bash -c "cd app && php_cs --standard=PSR12 src/"

load-fixtures:
	${DOCKER_EXEC} ${MAIN_CONTAINER} /bin/bash -c "cd app && php bin/console doctrine:fixtures:load"

run-tests:
	${DOCKER_EXEC} ${MAIN_CONTAINER} /bin/bash -c "cd app && php ./vendor/bin/phpunit"