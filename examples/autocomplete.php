<?php
require_once './config/configLibrairy.php';

use openSILEX\handsontablePHP\adapter\HandsontableSimple;
use openSILEX\handsontablePHP\classes\ColumnConfig;

/**
 * An example to load a PHP array in Handsontable with an autocomplete column create from a PHP array
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
    new ColumnConfig(),
    new ColumnConfig([
    'data' => 1,
    'type' => 'autocomplete',
    'source' => [
            'yellow',
            'red',
            'orange',
            'green',
            'blue',
            'gray',
            'black',
            'white'
        ]
    ]),
    new ColumnConfig(),
    new ColumnConfig(),
    new ColumnConfig(),
    new ColumnConfig()
    ]);

?>
<html>
    <head>
        <?= $hd->loadJSLibraries(true); ?>
        <?= $hd->loadCSSLibraries(); ?>
    </head>
    <br>
    <h3><b>Autocomplete</b></h3>
    <br>
    <?= $hd->render() ?>
</html>
