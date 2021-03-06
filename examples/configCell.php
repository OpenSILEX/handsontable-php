<?php
require_once './config/configLibrairy.php';

use openSILEX\handsontablePHP\adapter\HandsontableSimple;
use openSILEX\handsontablePHP\classes\CellConfigDefinition;

/**
 * An example to load a PHP array in Handsontable with a cell definition
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
// Cell config $row, $col, $readOnly
$hd->setCell([
    new CellConfigDefinition(0, 0, true)
    ]);
$hd->setCells(
    'var cellProperties = {};

    if (row === 0 && col === 0) {
      cellProperties.readOnly = true;
    }

    return cellProperties;
    '
);

?>
<html>
    <head>
        <?= $hd->loadJSLibraries(true); ?>
        <?= $hd->loadCSSLibraries(); ?>
    </head>
    <br>
    <h3><b>Set config cell</b></h3>
    <br>
    <?= $hd->render() ?>
</html>
