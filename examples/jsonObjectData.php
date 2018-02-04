<?php
require_once './config/ConfigLibrairy.php'; 

use openSILEX\handsontablePHP\adapter\HandsontableSimple;

/**
 * An example to load a PHP array which represents an object in Handsontable 
 * with a column JavaScript function schema 
 */

$hd = new HandsontableSimple();

$data = [
      ['id' => 1, 'name' => ['first' =>  'Ted','last' => 'Right'], 'address' => ''],
      ['id' => 2, 'address' => ''],
      ['id' => 3, 'name' => ['first' => 'Joan', 'last' => 'Well'], 'address' => '']
    ];   

$hd->setData($data);
$hd->setColHeaders(['ID', 'First Name', 'Last Name', 'Address']);

$hd->setColumns(function(){
    return "var columnMeta = {};

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
      return columnMeta;";
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
        echo $hd->generateJavascriptCode();
        ?>
    </script>
</html>
