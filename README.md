handsontable-php
=============

handsontable-php is a PHP library that works as a wrapper for the **Handsontable js** library (https://handsontable.com/) and it was built with flexibility and maintainability in mind.
It is a simple port of the JavaScript library to PHP, it was designed in a way to evolve in order that developer only needs to learn one API.


Setup
-----

The recommended way to install handsontable-php is through  [`Composer`](http://getcomposer.org). Just create a ``composer.json`` file and run the ``php composer.phar install`` command to install it:
```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/openSILEX/handsontable-php"
        }
    ],
    "require": {
        "openSILEX/handsontable-php": "dev-master"
    }
}
```

Usage
-----

** Simple case **

```php
require_once './config/configLibrairy.php';

use openSILEX\handsontablePHP\adapter\HandsontableSimple;

/**
 * An example to load a PHP array in Handsontable
 */

$hd = new HandsontableSimple();
$data = [
      ['', 'Tesla', 'Nissan', 'Toyota', 'Honda', 'Mazda', 'Ford'],
      ['2017', 10, 11, 12, 13, 15, 16],
      ['2018', 10, 11, 12, 13, 15, 16],
      ['2019', 10, 11, 12, 13, 15, 16],
      ['2020', 10, 11, 12, 13, 15, 16],
      ['2021', 10, 11, 12, 13, 15, 16]
    ];
$hd->setData($data);


?>
<html>
    <head>

        <?php
        echo $hd->loadJSLibraries(true);
        echo $hd->loadCSSLibraries();
        
        ?>
    </head>
    <div id='<?= $hd->getContainerName() ?>'>
        
    </div>
    <script>
        <?php
        echo $hd->generateJavascriptCode();
        ?>
    </script>
</html>

```
** Ajax case **

```php
<?php
require_once './config/configLibrairy.php';

use openSILEX\handsontablePHP\adapter\HandsontableSimple;
use openSILEX\handsontablePHP\classes\ColumnConfig;
use openSILEX\handsontablePHP\classes\AjaxSourceColumn;

/**
 * An example to load a PHP array in Handsontable with an autocomplete column create from an ajax source
 */

$hd = new HandsontableSimple();
$data = [
      ['', 'Tesla', 'Nissan', 'Toyota', 'Honda', 'Mazda', 'Ford'],
      ['2017', 10, 11, 12, 13, 15, 16],
      ['2018', 10, 11, 12, 13, 15, 16],
      ['2019', 10, 11, 12, 13, 15, 16],
      ['2020', 10, 11, 12, 13, 15, 16],
      ['2021', 10, 11, 12, 13, 15, 16]
    ];
$hd->setData($data);
$hd->setColumns([
    new ColumnConfig([
    'data' => 0,
    'type' => 'autocomplete',
    'source' => new AjaxSourceColumn('ajax/array.php')]),
    new ColumnConfig()
    ]);
?>

<html>
    <head>

        <?php
        echo $hd->loadJSLibraries(true);
        echo $hd->loadCSSLibraries();
        
        ?>
    </head>
    <div id='<?= $hd->getContainerName() ?>'>
        
    </div>
    <script>
        <?php
        echo $hd->generateJavascriptCode();
        ?>
    </script>
</html>
```