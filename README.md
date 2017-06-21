# Butterfly Framework

This is MVC based php framework.

## Features

    1. Bundle based system
    2. Create, remove bundles and controller with built-in CLI
    3. Fully developable php CLI
    4. Twig integration
    5. Built-in libraries which are
        1. Database class (extended PDO w/ query builder)
        2. Our own Exception class. (uses error codes and values)
        3. Loader class (for helpers, models, etc.)
        4. Path class (ex. route path, assets path)
        5. Request class for handling http post, get, file requests
        6. Route class for handling and pairing routes
        7. ...more coming...
    6. JSON formatted config tables which are
        1. database array(assoc)
        2. errors array(assoc)
        4. defaults object
        5. router array(assoc)
    7. Composer ready
    8. Seperated bundle and view files (under bundles and views)
    
--

## Bundle basics

Bundle structure should be like that

![Bundle Structure](https://image.prntscr.com/image/jsSNKCEFT3Su915_O2lEVA.png)

1. Root dir: should be lowercase charactered
2. Sub directories **must** be camel case
3. php files **must** be lowercase
4. Controller namespace template: `\Butterfly\Bundles\Home\Controllers`
--


## Controller Basics

Controller namespace is `\Butterfly\Bundles\Home\Controllers`. 'Home' is bundle name and it and class name must be camel case but file name is **totaly** lowercase. All controllers must be extended from `ActiveClass` and `ActiveClass` using to be added.

Arguments, `$parameters` and `$request` can be equalized `null` if you use them. But you dont have to specify them. They are for using form post/get handling and get parameter catching...

![Conroller Structure](https://image.prntscr.com/image/R6ksf14XTsO5cBROLlNjew.png)
--


## Model Basics

Model namespace is `Butterfly\Bundles\Home\Models`. 'Home' is bundle name and it and class name must be camel case but file name is totaly lowercase. All models must be extended from `ActiveClass`. I prefer properties are private and i write get-set methods. With this way property permission handling to be easier...

![Model Structure](https://image.prntscr.com/image/rmozgXFWQgyFAuSdgLlDlA.png)
--


## Helper Basics

Helper is not an object class.They are function libraries and contains just functions. I prefer function like that. 

![Helper Structure](https://image.prntscr.com/image/TxQapNKGQCq1fHLCXcTI1w.png)
--

## Loading Models, Helpers, Views

In some of controller method (extended `ActiveClass`) system libraries can be used '$this->getSomething()' methods. This methods are library object classes. If you load model from 
`__construct()` method it works every method.
 
 Example of loading model:
 
 ![Model Loading](https://image.prntscr.com/image/NCfR1iMnQK6amL2ZzXYbrQ.png)
 
 Example of loading helper:
 
 ![Helper Loading](https://image.prntscr.com/image/UmIqkqVQSBySnZ0Gi3v_-A.png)
 
 View loading is different from them. Because my template engine is `Twig` and using native `Twig` library from `packagist.org`
 
 Example of loading views:
 
 ![View Loading](https://image.prntscr.com/image/XO2VZphKTo2k22BtgawSJA.png)
 
 >Note: `Path` is global in twig so you can use `{{ Path.route('/login') }}` and other `Path` methods in twig files.
 
 
 
 ## Using CLI
 
 CLI can do:
 
 
 |          | Create |   Remove   | Check |
 |----------|--------|------------|-------|
 |Bundle    |*       |*           |*      |
 |Controller|*       |*           |*      |
 |Route     |*       |*           |-      |


CLI has main commands and this main commands have sub commands.

Command tree:

- create
    - controller
    - bundle
    - route
- remove
    - controller
    - bundle
    - route
- check
    - Bundle
    - Controller
    
Examples: 
Create route  /login or login is okay. But classpath **must** be like that
> `$ butterfly create route /login \Butterfly\Bundles\Controllers\Welcome\Main`

Create bundle  name **must** be **lowercase**
> `$ butterfly create bundle home`

Create controller  name template is `bundle:controller` and lowercase
> `$ butterfly create controller home:welcome`

Remove bundle name **must** be **lowercase**
> `$ butterfly remove bundle home`

Remove controller just like creating
> `$ butterfly remove controller home:welcome`

Remove route is easier of all
> `$ butterfly remove route login` or `$ butterfly remove route /login`

Check bundle name is **lowercase**
> `$ butterfly check bundle home`

Check controller name parameter just like creating and deleting
> `$ butterfly check controller home:main`

## Explanation Of Configurations
Configurations are `json` files and `config.php` file reads and categories them all. Some configs are `KeyValuePair arrays`, some configs `class objects` because of `json_decode()`.

1. `database.json` is configuration of database connection. I think everybody knows values of that file.
2. `defaults.json` is configuration of settings. Some of settings deadly not recommended to change. 
    - Do not change: 
        - `allowed_cli_commands` if you don't develop cli tool
        - `bundle_structure` never ever modify that.
    - Can be change: 
        - `errors` it is config of showing errors. i think keys are very understanable.
        - `route` if default route field which contains default route, bundle, controller and method
        - `meta` is meta data of site for ex. `application_name` for site name
 3. `errors.json` this is error strings.
 4. `router.json` this is our routing registry. You can modify yourself or add-remove routes from CLI as you wish...