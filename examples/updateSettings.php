<?php
require_once './config/configLibrairy.php';

use openSILEX\handsontablePHP\adapter\HandsontableSimple;
use openSILEX\handsontablePHP\classes\UpdateSettings;
use openSILEX\handsontablePHP\classes\ColumnConfig;
use openSILEX\handsontablePHP\classes\AjaxSourceColumn;

/**
 * An example to load a PHP array in Handsontable and change settings after initialization
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
$updateSettings = new UpdateSettings([
    'columns' => [
        new ColumnConfig([
            'data' => 0,
            'type' => 'autocomplete',
            'source' => new AjaxSourceColumn('ajax/array.php')]),
        new ColumnConfig(),
        new ColumnConfig()
    ]
]);
$hd->setUpdateSettings($updateSettings);
?>
<html>
    <head>
        <?= $hd->loadJSLibraries(true); ?>
        <?= $hd->loadCSSLibraries(); ?>
    </head>
        <br>
        <h3><b>Load custom settigns after initialization</b></h3>
        <br>
        <?= $hd->render() ?>
</html>
