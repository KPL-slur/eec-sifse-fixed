SISTEM INFORMASI EECID
=======================

HOW TO DEV
-----------
1. Clone the repo
2. Copy and rename the `.env.example` to `.env`
3. Edit your credentials in the `.env` file
- Database credentials
- Mail server configuration. Eg. mailtrap
4. Run `$ composer install` in the project directory
5. Run `$ composer dump-autoload`
6. Run `$ php artisan key:generate`
7. Run `$ php artisan migrate --seed`
8. Thats it, now run `$ php artisan serve`
9. Open your browser and fill the url `localhost:8000`
10. To test the app, use this credential to login. (This login data added by seeder)
- Admin credential email:`admin@eecid.com` password:`secret`
- Expert credential email:`eko@eecid.com` password:`12345`
- Or you can test the register features

HOW TO DEPLOY
--------------
TODO LATER
