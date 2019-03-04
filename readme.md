<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## About Laravel API Boilerplate
This is a boilerplate for writing RESTful API projects using Laravel. The aim of this project is to provide developers with scaffolding and functionality which will make writing APIs exceedingly quick, efficient and convenient.
The principles of this boilerplate are to;

 - Save developers considerable effort by using reasonable conventions
 - Allow for everything the boilerplate provides to be easily and entirely customised to suit developer needs, through normal PHP inheritance
   - As well as allow developers to easily use the boilerplate functionality and mix it in with their own implementation
 - Follow REST standards very closely
 - Use existing Laravel features and existing Laravel add-on packages where possible
 - Add many convenient features useful for writing APIs
 - Maintain a high level of performance

This boilerplate is designed to be used when starting a new API project. Therefore, instead of cloning the laravel repository, you should clone this one.

## Project Setup
You can (and should) set this up in exactly the same way as laravel. The minimal installation steps for local development are outlined below, and you should consult the Laravel documentation for comprehensive Laravel configuration options.

When setting up the project for the first time, please execute the following commands:

```bash
composer install
composer run post-root-package-install
php artisan key:generate
php artisan jwt:secret
php artisan ide-helper:generate
```

Additionally, please carry out the following steps:

 * Remove the composer.lock from the .gitignore file

## Boilerplate Documentation
All functionality and use cases provided by this boilerplate are documented in the [Project Wiki](https://github.com/specialtactics/l5-api-boilerplate/wiki).

### Boilerplate Structure
This boilerplate is essentially a raw installation of Laravel 5, with various customisations.

In order to keep the changes to Laravel itself to a minimum, most heavy lifting is done by the supporting package [l5-api](https://github.com/specialtactics/l5-api). This allows for easier updating and forward compatibility, while minimising clutter in your root repository.

The "l5-api" package has base "restful" elements - such as controllers, models, transformers, middleware, helpers and other things - designed to make Laravel more API-friendly. Meanwhile, changes to the laravel repository ensure these elements are properly used and integrated into Laravel itself.

### Versions

This table shows you which versions of this boilerplate mirror which versions of Laravel.

| Laravel Version | Boilerplate Version | Minimum PHP Version |
|-----------------|---------------------|---------------------|
| 5.6             | 0.x.x-dev           | 7.1                 |
| 5.7             | 0.x.x-dev           | 7.1                 |
| 5.8             | 0.1                 | 7.1                 |

## Automated Testing

This boilerplate is using Laravel's phpunit tests. You will find API tests in their own directory, and suite. Some tests have been written for the existing endpoints to get you started.

To run tests on the commandline;

```bash
composer test
```

The convention used is that every test file will fresh and seed the database once only, at the start - in order to save execution time.

## Contributing

If you would like to contribute to this project, please feel free to submit a pull request. If you plan to do any major work - it may be worthwhile messaging the author beforehand to explain your plans and get them approved.

Please keep in mind, this package is only the template portion of the boilerplate, the other portion is [l5-api](https://github.com/specialtactics/l5-api). Before adding any new functionality you should consider whether it's possible at all to keep it out of this project and rather put it into l5-api, as that is preferred.

## Check out the documentation of supporting projects

Every great project stands on the shoulders of giants. Check out the documentation of these key projects to learn more.

 - [Laravel](https://laravel.com/docs/)
 - [Dingo API](https://github.com/dingo/api/wiki)
 - [Tymon JWT Auth](https://github.com/tymondesigns/jwt-auth)
 - [League Fractal](https://fractal.thephpleague.com/)
 - [Laravel UUID](https://github.com/webpatser/laravel-uuid/tree/2.1.1)

## Recommended Packages

I have tried to include only the packages thought absolutely necessary, so here is a list of packages I recommend checking out:

 - [Bugsnag for Laravel](https://github.com/bugsnag/bugsnag-laravel)
 - [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
 

## Todo
 - Add pagination to child controller getAll() (requires a bit of a rewrite of how that works)
 - Think of an easy way to deal with needing to hide relationships 
 - Docs
 - One command to generate multiple things (eg. Controller, Model, pre-fill controller with model class; then DB)
 - Add command to make a new transformer
 - Integrate this https://github.com/spatie/laravel-query-builder
 - Add primitive transformers
 - Add config & allow ID to be added to model resource
 - Write more tests
 - Allow for authentication using only JWT, with middleware (for high speed requests)
 - Bulk delete
 - Bulk put/post
 - Abstract all string text into language files
 - Logging of API requests using middleware

## License
 
This boilerplate, much like the Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
