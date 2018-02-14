<?php

require_once './config/configLibrairy.php';

use openSILEX\handsontablePHP\adapter\HandsontableSimple;
use openSILEX\handsontablePHP\classes\AjaxSourceColumn;
use openSILEX\handsontablePHP\classes\ColumnConfig;
use \openSILEX\handsontablePHP\classes\JSFunction;
/**
 * An example to load a PHP array in Handsontable
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
        new ColumnConfig(['data' => 0]),
        new ColumnConfig(['data' => 2, 'type' => 'date']), // date exemple
        new ColumnConfig(['data' => 1, 'type' => 'autocomplete' ,'source' => new AjaxSourceColumn('ajax/array2.php')]),
        new ColumnConfig(['data' => 3, 'type' => 'autocomplete' ,
                    'source' => new JSFunction(
                        "function (query, process) {
                        $.ajax({
                          url: 'ajax/array2.php',
                          dataType: 'json',
                          data: {
                            query: query
                          },
                          success: function (response) {
                            console.log('response', response);
                            process(response.data);
                          }
                        });
                  }")])
                ]);
?>
<html>
    <?= $hd->generateLibrairyContainerHTScript(true) ?>
</html>
