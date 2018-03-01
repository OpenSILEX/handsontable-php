<?php

require_once './config/configLibrairy.php';

use openSILEX\handsontablePHP\adapter\HandsontableSimple;

/**
 * An example to save Handsontable data with ajax
 */

$hd = new HandsontableSimple();
$hd->setSaveAction('ajax/save.php');

?>
<html>
    <head>
        <?= $hd->loadJSLibraries(true); ?>
        <?= $hd->loadCSSLibraries(); ?>
    </head>
    <br>
    <h3><b>Save data with ajax</b></h3>
    <br>
    <?= $hd->generateSaveButton() ?>
    <?= $hd->render() ?>
</html>
