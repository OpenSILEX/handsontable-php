<?php
require_once './config/configLibrairy.php';

use openSILEX\handsontablePHP\adapter\HandsontableSimple;
// NOT WORKING

/**
 * An example to set handsontable events
 * @todo Need more development 
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
$hd->addEvent('test','click', "alert('click');");
?>
<html>
    <head>
<?= $hd->loadJSLibraries(true); ?>
        <?= $hd->loadCSSLibraries(); ?>
    </head>
        <?= $hd->render() ?>
    <div id="test"></div>
</html>
