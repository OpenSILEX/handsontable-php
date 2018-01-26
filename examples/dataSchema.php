<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

use inra\handsontable\adapter\HandsontableSimple;

$hd = new HandsontableSimple();


$data = [
      ['id' => 1, 'name' => ['first' =>  'Ted','last' => 'Right'], 'address' => ''],
      ['id' => 2, 'address' => ''],
      ['id' => 3, 'name' => ['first' => 'Joan', 'last' => 'Well'], 'address' => '']
    ];   

$hd->setData($data);
$hd->setColHeaders(['ID', 'First Name', 'Last Name', 'Address']);
$hd->setDataSchema(new DataSchema(['id' => null, 'name' => ['first' => null, 'last' => null], 'address' => null]));

//
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
        echo $hd->renderJavascriptCode();
        ?>
    </script>
</html>
