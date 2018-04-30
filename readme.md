<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## About Laravel API Boilerplate
This is a boilerplate for writing API projects using Laravel. The aim of this project is to provide users with scaffolding and functionality which will make writing APIs quick, efficient and convenient.

## Project Setup
You can (and should) set this up in exactly the same way as laravel. Any extra setup steps are outlined below.

When setting up the project for the first time, please execute the following commands:

```bash
php artisan jwt:secret
```

Additionally, please carry out the following steps:

 * Remove the composer.lock from the .gitignore file

## Boilerplate Documentation

### Boilerplate Parts
This boilerplate is essentially a raw installation of Laravel 5, with some customisations. In order to keep the changes to Laravel itself to a minimum (in order to not clutter the new projects, and also make it easier to update), 
most heavy lifting is done by the supporting package [l5-api](https://github.com/specialtactics/l5-api).

The "l5-api" package has base "restful" elements - such as controllers, models, transformers and other things, designed to make Laravel more API-friendly.

### Versioning

This table shows you which versions of this package are based on which version of Laravel

| Laravel Version | Boilerplate Version | Minimum PHP Version |
|-----------------|---------------------|---------------------|
| 5.6             | 0.x.x               | 7.1                 |

### Over-riding
This boilerplate does not aim to be too prescriptive, and almost all classes from the supporting l5-api package exist inside it, already overridden and ready for you to customise. 

### Generators

Artisan generators have been re-written for some key features to ensure they comply with the boilerplate. Namely;
 
 * Controllers
 * Models
 * Seeds

### Extra Configuration

This boilerplate has several additional configuration files you should be aware of:
 
 * api.php
 * jwt.php

## Contributing

If you would like to contribute to this project, please feel free to submit a pull request. If you plan to do any major work - it may be worthwhile messaging the author beforehand to explain your plans and get them approved.

Please keep in mind, this package is only the template portion of the boilerplate, the other portion is [l5-api](https://github.com/specialtactics/l5-api).

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
 

## License
 
This boilerplate, much like the Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
