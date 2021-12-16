CONSOLE = symfony console
COMPOSER = composer

.PHONY: init
init:	# Create env.local
	@echo '\033[1;42m The .env.local was just created. Feel free to put your config in it.\033[0m';
	@cp ./.env ./.env.local;

.PHONY: db-diff
db-diff:
	${CONSOLE} doctrine:schema:update --dump-sql
