<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../../vendor/autoload.php';

use openSILEX\handsontablePHP\adapter\HandsontableSimple;

use openSILEX\handsontablePHP\classes\CellConfigDefinition;

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
$hd->setCell([new CellConfigDefinition(0, 0, true)]);
$hd->setCells(function(){
    return 'var cellProperties = {};

      if (row === 0 && col === 0) {
        cellProperties.readOnly = true;
      }

      return cellProperties;
      ';
    
}); 




?>
<html>
    <head>

        <?php
        echo $hd->loadJSLibraries(true);
        echo $hd->loadCSSLibraries();
        
        ?>
    </head>
    <div id='<?= $hd->getContainerName() ?>'>
        
    </div>
    <script>
        <?php
        echo $hd->renderJavascriptCode();
        ?>
    </script>
</html>
