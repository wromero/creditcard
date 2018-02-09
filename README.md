Symfony Demo Application and Credit Card Validator Command
==========================================================

The "Symfony Demo Application" is a reference application created to show how
to develop Symfony applications following the recommended best practices. 
A command has been added to the application in order to implement a Credit 
Card validation algorithm called Luhn.



Requirements
------------

  * PHP 5.5.9 or higher;
  * PDO-SQLite PHP extension enabled;
  * and the [usual Symfony application requirements](https://symfony.com/doc/current/reference/requirements.html).

If unsure about meeting these requirements, download the demo application and
browse the `http://localhost:8000/config.php` script to get more detailed
information.

Installation
------------


```bash
$ git clone https://github.com/wromero/creditcard.git creditcard
$ cd creditcard/
$ composer install --no-interaction
```



Usage
-----



**VALIDATOR**

The validator is a command that runs in the console. In order to use it, you need to provide a number 
passed as a parameter to evaluate it if it is a valid credit card number or not. The source code of 
the command can be found at _**src/AppBundle/Command/ValidateCreditCardCommand**_. It can be used as follows:
```bash
$ php bin/console stackbuilders:validate 4012888888881881

``` 
The result will be:
```bash
$ 4012888888881881 is a valid credit card number.
``` 

The application also has a sample test for the command. It can be executed as follows:

```bash
$ vendor/bin/simple-phpunit tests/AppBundle/Command/ValidCreditCardCommandTest.php

```