<?php
require_once './config/configLibrairy.php';

use openSILEX\handsontablePHP\adapter\HandsontableSimple;
use openSILEX\handsontablePHP\classes\ColumnConfig;

/**
 * An example to load a PHP array in Handsontable with a column definition
 */

$hd = new HandsontableSimple();
$data = [
    ['2017', 10, '05/02/2018', 12, 13, 15, 16],
    ['2018', 10, '05/02/2018', 12, 13, 15, 16],
    ['2019', 10, '05/02/2018', 12, 13, 15, 16],
    ['2020', 10, '05/02/2018', 12, 13, 15, 16],
    ['2021', 10, '05/02/2018', 12, 13, 15, 16]
];
$hd->setData($data);
$hd->setColHeaders(['Year', 'Tesla', 'Date', 'Toyota', 'Honda', 'Mazda', 'Ford']);
$hd->setColumns([
        new ColumnConfig([
            'data' => 1
            ]),
        new ColumnConfig([
            'data' => 2, 
            'type' => 'date'
            ]), // date exemple
        new ColumnConfig([
            'data' => 2, 
            'type' => 'date'
            ])
    ]);

?>
<html>
    <head>
        <?= $hd->loadJSLibraries(true); ?>
        <?= $hd->loadCSSLibraries(); ?>
    </head>
    <br>
    <h3><b>Load column</b></h3>
    <br>
    <?= $hd->render() ?>
</html>
