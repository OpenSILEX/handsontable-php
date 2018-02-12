<?php
require_once './config/configLibrairy.php';

use openSILEX\handsontablePHP\adapter\HandsontableSimple;
use openSILEX\handsontablePHP\classes\DataSchema;

/**
 * An example to load a PHP array which represents an object in Handsontable with a data schema
 */

$hd = new HandsontableSimple();

$data = [
      ['id' => 1, 'name' => ['first' =>  'Ted','last' => 'Right'], 'address' => ''],
      ['id' => 2, 'address' => ''],
      ['id' => 3, 'name' => ['first' => 'Joan', 'last' => 'Well'], 'address' => '']
    ];

$hd->setData($data);
$hd->setColHeaders(['ID', 'First Name', 'Last Name', 'Address']);
$hd->setDataSchema(new DataSchema(
    [
                    'id' => null,
                    'name' => [
                        'first' => null,
                        'last' => null],
                        'address' => null
                    ]
                ));

$hd->setColumns(
        "var columnMeta = {};

      if (column === 0) {
        columnMeta.data = 'id';

      } else if (column === 1) {
        columnMeta.data = 'name.first';

      } else if (column === 2) {
        columnMeta.data = 'name.last';

      } else if (column === 3) {
        columnMeta.data = 'address';

      } else {
        columnMeta = null;

      }

      return columnMeta;"
);


?>
<html>
    <head>
        <?= $hd->loadJSLibraries(true); ?>
        <?= $hd->loadCSSLibraries(); ?>
    </head>
    <?= $hd->render() ?>
</html>
