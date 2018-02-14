<?php

require_once './config/configLibrairy.php';

use openSILEX\handsontablePHP\adapter\HandsontableSimple;

/**
 * An example to load a PHP array in Handsontable
 */

$hd = new HandsontableSimple();
// create example data
$hd->generateSpreadsheetDataHelper(100, 50);
// on right click in the context
$hd->setManualColumnFreeze(true);
$hd->setFixedColumnsLeft(2);
$hd->setFixedRowsTop(2);
?>
<html>
    <head>
        <?= $hd->loadJSLibraries(true); ?>
        <?= $hd->loadCSSLibraries(); ?>
    </head>
    <?= $hd->render() ?>
</html>
