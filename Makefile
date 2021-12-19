console = symfony console
compose = composer

.PHONY: init
init: # Create env.local
	@echo '\033[1;42m The .env.local was just created. Feel free to put your config in it.\033[0m';
	@cp -n ./.env ./.env.local;

.PHONY: db-diff
db-diff:
	${console} doctrine:schema:update --dump-sql

.PHONY: db-reset
db-reset: # reset database
	${console} d:d:d --force --if-exists
	${console} d:d:c --if-not-exists
	${console} d:m:m -n

.PHONY: composer-install
composer-install: # install project dependencies
	symfony composer install

.PHONY: composer-update
composer-update: # update project dependencies
	symfony composer update

.PHONY: cs-check
cs-check: # execute php-cs-fixer analyzer
	symfony php ./vendor/bin/php-cs-fixer fix --allow-risky=yes --dry-run

.PHONY: cs-fix
cs-fix: # execute php-cs-fixer analyzer and fix
	symfony php ./vendor/bin/php-cs-fixer fix --allow-risky=yes

.PHONY: psalm
psalm: # execute psalm analyzer
	symfony php ./vendor/bin/psalm
