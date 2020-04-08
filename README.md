[![Build Status](https://travis-ci.org/unik-codes/ark-installer.svg?branch=master)](https://travis-ci.org/unik-codes/ark-installer) [![Latest Stable Version](https://poser.pugx.org/unik-codes/ark-installer/v/stable)](https://packagist.org/packages/unik-codes/ark-installer) [![Total Downloads](https://poser.pugx.org/unik-codes/ark-installer/downloads)](https://packagist.org/packages/unik-codes/ark-installer) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/unik-codes/ark-installer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/unik-codes/ark-installer/?branch=master) [![License](https://poser.pugx.org/unik-codes/ark-installer/license)](https://packagist.org/packages/unik-codes/ark-installer)

## About Ark Installer

Ark Installer is a package to create a new Ark project.

## Installation

```
$ composer global require unik-codes/ark-installer
```

## Usage

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
