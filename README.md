# Laravel RESTful API for [Cybersource](https://www.cybersource.com/en-us.html) integration

RESTful API endpoint for simple order checkout using Laravel8x and cybersource/rest-client-php package.
## Installation
#### Composer install
```bash
composer install
```
#### Laravel env
```bash
cp .env.example .env
MERCHANT_ID=<merchantID>
APIKEY_ID=<merchantKeyID>
SECRET_KEY=<merchantSecretKey>
KEY_ALIAS=<merchantID>
KEY_PASS=<merchantID>
KEY_FILE_NAME=<merchantID>
// For TESTING use
RUN_ENV=cyberSource.environment.SANDBOX
// For PRODUCTION use
RUN_ENV=cyberSource.environment.PRODUCTION
```
#### Laravel key generate
```bash
php artisan key:generate
```
#### Laravel passport install
```bash
php artisan passport:install
```
#### Laravel migrate and seed
```bash
php artisan migrate --seed
```
#### Auto dumpload
```bash
composer dumpautoload
```
#### Run server
```bash
php artisan serve
```

URL: http://localhost:8000/api/cybersources/checkout
<br>
Method: POST
<br>
Params:
```json
{
	"number": 4111111111111111,
	"expiration_month": 12,
	"expiration_year": 2031,
	"total_amount": "150",
	"currency": "USD",
	"first_name": "Devdream",
	"last_name": "Solution",
	"address1": "1 Market St",
	"locality": "San Francisco",
	"administrative_area": "CA",
	"postal_code": 94105,
	"country": "US",
	"email": "q3construction1@gmail.com",
	"phone_number": "4158880000"
}
```

