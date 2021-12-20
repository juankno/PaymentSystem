# PaymentSystem starter

This is a basic system for implementing payments in different branches.

## Getting started

### Launch the starter project

*(Assuming you've [installed Laravel](https://laravel.com/docs/7.x))*

Fork this repository, then clone your fork, and run this in your newly created directory:

``` bash
composer install
```

This project use *([laravel ui](https://laravel.com/docs/7.x/frontend)* for the frontend Scaffolding
``` bash
npm install && npm run dev
```

Next you need to make a copy of the `.env.example` file and rename it to `.env` inside your project root.

Run the following command to generate your app key:

```
php artisan key:generate
```

Then start your server:

```
php artisan serve
```

Next config your database and use:
```
php artisan migrate
```

If you are work in local mode you can use the seeders in the migration:
```
php artisan migrate:refresh --seed or force with | php artisan migrate:fresh --seed
```


*If you need more information about paypal api or Stripe then you can read the documentation
*([Stripe Api](https://stripe.com/docs)*
*([Paypal Developer](https://developer.paypal.com/home)*

Your Laravel starter project is now up and running! 


## Licence
The Laravel framework and this project is open-sourced software licensed under the MIT license.
