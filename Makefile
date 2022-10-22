console = symfony console

# Executables
PHP      = php
COMPOSER = composer
GIT      = git
YARN     = yarn

# Executables: local only
SYMFONY_CLI    = symfony
DOCKER         = docker
DOCKER_COMPOSE = docker compose

# Executables: vendors
PHP_CS_FIXER  = ./vendor/bin/php-cs-fixer

# Alias
SYMFONY         = $(SYMFONY_CLI)
SYMFONY_CONSOLE = $(SYMFONY_CLI) console

##--------------✨ Project ✨--------------
.PHONY: help
help: ## Help
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

.PHONY: init
init: ## Install project
	@echo '\033[1;42m The .env.local was just created. Feel free to put your config in it.\033[0m';
	@cp -n ./.env ./.env.local;

.PHONY: reset
reset: ## Reset project
	$(MAKE) db-reset
	$(MAKE) db-migrations

.PHONY: restart-all
restart-all: ## Restart all server
	@sudo service nginx restart
	@sudo service php8.0-fpm restart
	@sudo service postgresql

.PHONY: lint-all
lint-all: lint-cs lint-ps lint-twig lint-doctrine lint-container lint-es ## Lint project

.PHONY: fix-all
fix-all: fix-cs fix-ps ## Fix project

##--------------✨ Docker ✨--------------
.PHONY: up
up: ## Start the docker hub
	$(DOCKER_COMPOSE) up --force-recreate --no-deps --build -d
	@#sudo sed -i '/dev.iqra.docker/c\'"$$(docker inspect -f "{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}" nginx) dev.iqra.docker" /etc/hosts
	@truncate -s 0 ${PWD}/docker/logs/*/*.log

.PHONY: build
build: ## Builds the images
	$(DOCKER_COMPOSE) build --pull --no-cache

.PHONY: down
down: ## Stop the docker hub
	$(DOCKER_COMPOSE) down --remove-orphans

##--------------✨ Database ✨--------------
.PHONY: db-diff
db-diff: ## Database diff
	${console} doctrine:schema:update --dump-sql

.PHONY: db-reset
db-reset: ## Database reset
	${console} d:d:d --force --if-exists
	${console} d:d:c --if-not-exists
	${console} d:s:c --dump-sql
	${console} d:s:c

.PHONY: db-migrations
db-migrations: ## Database migrations
	@symfony console doctrine:migrations:migrate -n

##--------------✨ Composer ✨--------------
.PHONY: composer-install
composer-install: ## Composer install
	symfony composer install

.PHONY: composer-update
composer-update: ## Composer update
	symfony composer update

##--------------✨ Linting ✨--------------
.PHONY: lint-cs
lint-cs: ## PHP CS Fixer analyzer
	symfony php ./vendor/bin/php-cs-fixer fix --dry-run -v

.PHONY: lint-ps
lint-ps: ## Psalm analyzer
	symfony php ./vendor/bin/psalm

.PHONY: lint-es
lint-es: ## ESLint analyzer
	./node_modules/.bin/eslint assets

.PHONY: lint-twig
lint-twig: ## Linting Twig Templates
	symfony console lint:twig

.PHONY: lint-doctrine
lint-doctrine: ## Validate the mappings
	symfony console doctrine:schema:validate

.PHONY: lint-container
lint-container: ## Validate type hint arguments
	symfony console lint:container

##--------------✨ Fixing ✨--------------
.PHONY: fix-cs
fix-cs: ## Execute PHP CS Fixer
	symfony php ./vendor/bin/php-cs-fixer fix

.PHONY: fix-ps
fix-ps: ## Execute Psalm
	symfony php ./vendor/bin/psalter --issues=all
