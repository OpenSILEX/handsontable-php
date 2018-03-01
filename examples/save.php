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
    <?= $hd->generateSaveButton() ?>
    <?= $hd->render() ?>
</html>
