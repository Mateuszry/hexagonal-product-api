# Hexagonal product API
It is a REST API project in Symfony 5 written in PHP 7.4 with 8.0 MYSQL database.

## Project setup for developers
1. Run `make up` in the main directory
2. Run database migrations `make database-migrate`
3. Application is available on http://localhost:8080 and database on localhost:3306

## Code analysis
- `make php-cs-fixer` - command tries to fix as much coding standards problems as it can
- `make php-cs-fixer-dry-run` - run the fixer without making changes in files
- `make phpstan` - run PHP Static Analysis Tool which focuses on finding errors in code without actually running it

## Tests
- `make test` - run all PHPUnit tests

## Database
- `make database-migrate` - execute migrations
- `make database-diff` - check differences between current database schema and models to create proper migrations
