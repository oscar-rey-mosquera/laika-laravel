
# Test laika
- Base de datos test laika_test
- Base de datos laika

```bash
git clone https://github.com/oscar-rey-mosquera/laika-laravel.git
cd laika-laravel
cp .env.example .env
php artisan key:generate
```
## Crear base de datos mysql
```bash
mysql -u root -p
create databases laika_test;
create databases laika;
exit
```
## Ejecución de migraciones
```bash
php artisan migrate
```
## Code coverage (cobertura de test) y ejecución de test
```bash
php artisan test --coverage
```

