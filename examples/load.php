<?php

require_once './config/configLibrairy.php';

use openSILEX\handsontablePHP\adapter\HandsontableSimple;

/**
 * An example to load a PHP array in Handsontable
 */

$hd = new HandsontableSimple();
$hd->setLoadAction('ajax/load.php');

?>
<html>
    <head>
        <?= $hd->loadJSLibraries(true); ?>
        <?= $hd->loadCSSLibraries(); ?>
    </head>
    <br>
    <h3><b>Load data with ajax</b></h3>
    <br>
    <?= $hd->generateLoadButton() ?>
    <?= $hd->render() ?>
</html>
