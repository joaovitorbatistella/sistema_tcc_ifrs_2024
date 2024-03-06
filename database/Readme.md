### To update databse
```sh
docker-compose exec app php artisan migrate
```
---
### !! Only for the first time !!
##### Fill country, state and city tables samples
```sh
docker-compose exec app php artisan db:seed --class=CountriesSeeder
docker-compose exec app php artisan db:seed --class=StatesSeeder
docker-compose exec app php artisan db:seed --class=CitiesSeeder
```