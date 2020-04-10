[![Build Status](https://travis-ci.org/unik-codes/ark-installer.svg?branch=master)](https://travis-ci.org/unik-codes/ark-installer) [![Latest Stable Version](https://poser.pugx.org/unik-codes/ark-installer/v/stable)](https://packagist.org/packages/unik-codes/ark-installer) [![Total Downloads](https://poser.pugx.org/unik-codes/ark-installer/downloads)](https://packagist.org/packages/unik-codes/ark-installer) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/unik-codes/ark-installer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/unik-codes/ark-installer/?branch=master) [![License](https://poser.pugx.org/unik-codes/ark-installer/license)](https://packagist.org/packages/unik-codes/ark-installer)

## About Ark Installer

Ark Installer is a package to create a new Ark project.

## Installation

```
$ composer global require unik-codes/ark-installer
```

## Usage

Ark Installer come with 3 main commands:

1. `ark new <project name> <path>` - Create a new Ark project
2. `ark install <component>` - Install Ark component to the existing Laravel project
3. `ark compose <path>` - Install Ark dependencies

### Create a New Ark project

To create a new Ark project, simply run:

```
$ ark new "You Project Name"
```

You should have the Ark created in current path in `your-project-name` directory.

If you need to create a new Ark project in different path, you may provide 2nd argument:

```
$ ark new "You Project Name" "/var/www/"
```

You should have the Ark created in `/var/www/your-project-name`.

### Install Ark Dependencies

You can install Ark related packages to existing Laravel project by running following command:

```
$ ark compose "/path-to-your-project"
```

Ark rely on following packages and you might need to further setup the Ark in your Laravel project.

- [404labfr/laravel-impersonate](https://github.com/404labfr/laravel-impersonate)
- [laravel/passport](https://github.com/laravel/passport)
- [owen-it/laravel-auditing](https://github.com/owen-it/laravel-auditing)
- [predis/predis](https://github.com/predis/predis)
- [realrashid/sweet-alert](https://github.com/realrashid/sweet-alert)
- [tightenco/ziggy](https://github.com/tightenco/ziggy)
- [yadahan/laravel-authentication-log](https://github.com/yadahan/laravel-authentication-log)
- [spatie/image-optimizer](https://github.com/spatie/image-optimizer)
- [spatie/laravel-medialibrary](https://github.com/spatie/laravel-medialibrary)
- [spatie/laravel-permission](https://github.com/spatie/laravel-permission)
- [cleaniquecoders/blueprint-macro](https://github.com/cleaniquecoders/blueprint-macro)
- [cleaniquecoders/laravel-observers](https://github.com/cleaniquecoders/laravel-observers)
- [cleaniquecoders/laravel-uuid](https://github.com/cleaniquecoders/laravel-uuid)
- [cleaniquecoders/laravel-helper](https://github.com/cleaniquecoders/laravel-helper)

### Install Ark Component to the Existing Laravel Project

You can use `ark install <component-name>` to install related component.

Available components:

- `medialibrary`
- `migration`
- `docs`
- `seeder`
- `support`
- `model`

To install the component:

```
$ ark install model "/path-to-your-project"
```

Do take note, some of the components are rely on the [Install Ark Dependencies](#install-ark-dependencies).

## Contributing

Thank you for considering contributing to the Ark Installer!

### Bug Reports

To encourage active collaboration, it is strongly encourages pull requests, not just bug reports. "Bug reports" may also be sent in the form of a pull request containing a failing test.

However, if you file a bug report, your issue should contain a title and a clear description of the issue. You should also include as much relevant information as possible and a code sample that demonstrates the issue. The goal of a bug report is to make it easy for yourself - and others - to replicate the bug and develop a fix.

Remember, bug reports are created in the hope that others with the same problem will be able to collaborate with you on solving it. Do not expect that the bug report will automatically see any activity or that others will jump to fix it. Creating a bug report serves to help yourself and others start on the path of fixing the problem.

## Coding Style

Ark Installer follows the PSR-2 coding standard and the PSR-4 autoloading standard. 

You may use PHP CS Fixer in order to keep things standardised. PHP CS Fixer configuration can be found in `.php_cs`.

## Security Vulnerabilities

If you discover a security vulnerability within Ark Installer, please send an e-mail to Nasrul Hazim at nasrulhazim.m@gmail.com. All security vulnerabilities will be promptly addressed.

## Test

To run the test, type `vendor/bin/phpunit` in your terminal.

To have codes coverage, please ensure to install PHP XDebug then run the following command:

```
$ vendor/bin/phpunit -v --coverage-text --colors=never --stderr
```

## License

The Ark Installer is an open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
