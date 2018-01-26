<?php

namespace inra\handsontable\classes;

use inra\handsontable\tools\JsonExpression;
use inra\handsontable\classes\Columns;
use inra\handsontable\classes\CellsConfig;
use inra\handsontable\classes\CellConfig;

/**
 * Description of Handsontable
 *
 * @author charlero
 */
abstract class Handsontable {

    protected $containerName;
    protected $loadLibrairy = true;
    protected $loadDataSource;
    protected $saveDataSource;
    protected $infoDivId;
    protected $save = false;
    protected $autosave = false;
    protected $loadAction = false;
    protected $loadElementId;
    protected $saveElementId;
    // Handsontable attr
    protected $cell = null;
    protected $cells = null;
    protected $startRows;
    protected $startCols;
    protected $data = null;
    protected $columns = null;
    protected $width = null;
    protected $height = null;
    protected $rowHeaders = true;
    protected $colHeaders = true;
    protected $dataSchema = null;
    protected $contextMenu = ['row_above', 'row_below', 'remove_row', 'undo', 'redo','copy', 'cut'];
    protected $autoWrapRow = true;
    protected $minSpareRows = 1;
    protected $maxCols;
    protected $rowHeights;
    protected $colWidths;
    protected $sortIndicator = false;
    protected $manualColumnResize = false;
    protected $manualRowResize = false;
    public static $table_created = 0;

    public function __construct($container_name = null, $cellConfig = null) {
        if ($cellConfig != null) {
            $this->cell = $cellConfig;
        }
        if (is_null($container_name)) {
            $this->containerName = 'handsontable' . Handsontable::$table_created;
        } else {
            $this->containerName = $container_name;
        }

        Handsontable::$table_created++;
    }

    function getContainerName() {
        return $this->containerName;
    }

    function getLoadLibrairy() {
        return $this->loadLibrairy;
    }

    function getLoadDataSource() {
        return $this->loadDataSource;
    }

    function getSaveDataSource() {
        return $this->saveDataSource;
    }

    function getSave() {
        return $this->save;
    }

    function getAutosave() {
        return $this->autosave;
    }

    function getLoadAction() {
        return $this->loadAction;
    }

    function getSaveElementId() {
        if (is_null($this->saveElementId)) {
            $this->saveElementId = 'save' . Handsontable::$table_created;
        }
        return $this->saveElementId;
    }

    function getStartRows() {
        return $this->startRows;
    }

    function getStartCols() {
        return $this->startCols;
    }

    function getWidth() {
        return $this->width;
    }

    function getHeight() {
        return $this->height;
    }

    function getRowHeaders() {
        return $this->rowHeaders;
    }

    function getColHeaders() {
        return $this->colHeaders;
    }

    function getContextMenu() {
        if (!is_array($this->contextMenu) && !is_bool($this->contextMenu)) {
            return false;
        }
        return $this->contextMenu;
    }

    function getAutoWrapRow() {
        return $this->autoWrapRow;
    }

    function getMaxCols() {
        return $this->maxCols;
    }

    function getData() {
        return json_encode($this->data);
    }

    function getDataSchema() {
        return $this->dataSchema;
    }

    function getMinSpareRows() {
        return $this->minSpareRows;
    }

    function getRowHeights() {
        if (!is_array($this->rowHeights) && !is_int($this->rowHeights)) {
            return null;
        }
        return $this->rowHeights;
    }

    function getColWidths() {
        if (!is_array($this->colWidths) && !is_int($this->colWidths)) {
            return null;
        }
        return $this->colWidths;
    }

    function getManualColumnResize() {
        return $this->manualColumnResize;
    }

    function getManualRowResize() {
        return $this->manualRowResize;
    }
    
    function getSortIndicator() {
        return $this->sortIndicator;
    }

    function setSortIndicator($sortIndicator) {
        $this->sortIndicator = $sortIndicator;
    }

    
    function setRowHeights($rowHeights) {

        $this->rowHeights = $rowHeights;
    }

    function setColWidths($colWidths) {
        $this->colWidths = $colWidths;
    }

    function setManualColumnResize($manualColumnResize) {

        $this->manualColumnResize = $manualColumnResize;
    }

    function setManualRowResize($manualRowResize) {
        $this->manualRowResize = $manualRowResize;
    }

    function setMinSpareRows($minSpareRows) {
        $this->minSpareRows = $minSpareRows;
    }

    function setDataSchema($dataSchema) {
        $this->dataSchema = $dataSchema;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setContainerName($containerName) {
        $this->containerName = $containerName;
    }

    function setLoadLibrairy($loadLibrairy) {
        $this->loadLibrairy = $loadLibrairy;
    }

    function setLoadDataSource($loadDataSource) {
        $this->loadDataSource = $loadDataSource;
    }

    function setSaveDataSource($saveDataSource) {
        $this->saveDataSource = $saveDataSource;
    }

    function setSave($save) {
        $this->save = $save;
    }

    function setAutosave($autosave) {
        $this->autosave = $autosave;
    }

    function setLoadAction($loadAction) {
        $this->loadAction = $loadAction;
    }

    function setSaveElementId($saveElementId) {
        $this->saveElementId = $saveElementId;
    }

    function setStartRows($startRows) {
        $this->startRows = $startRows;
    }

    function setStartCols($startCols) {
        $this->startCols = $startCols;
    }

    function setWidth($width) {
        $this->width = $width;
    }

    function setHeight($height) {
        $this->height = $height;
    }

    function setRowHeaders($rowHeaders) {
        $this->rowHeaders = $rowHeaders;
    }

    function setColHeaders(array $colHeaders) {
        if (!is_array($this->colHeaders) && !is_bool($this->colHeaders)) {
            return true;
        }
        $this->colHeaders = $colHeaders;
    }

    function setContextMenu($contextMenu) {
        $this->contextMenu = $contextMenu;
    }

    function setAutoWrapRow($autoWrapRow) {
        $this->autoWrapRow = $autoWrapRow;
    }

    function setMaxCols($maxCols) {
        $this->maxCols = $maxCols;
    }

    function getColumns() {
        return $this->columns;
    }

    function getCell() {
        return $this->cell;
    }

    function getCells() {
        return $this->cells;
    }

    function setCells($cells) {
        $this->cells = new CellsConfig($cells);
    }

    function setCell($cell) {
        $this->cell = new CellConfig($cell);
    }

    function setColumns($columns) {
        $this->columns = new Columns($columns);
    }

    static function setTable_created($table_created) {
        self::$table_created = $table_created;
    }

    function getLoadElementId() {
        if (is_null($this->loadElementId)) {
            $this->loadElementId = 'load' . Handsontable::$table_created;
        }
        return $this->loadElementId;
    }

    function setLoadElementId($load_element_id) {
        $this->loadElementId = $load_element_id;
    }

    protected function getInfoDivId() {
        if (is_null($this->infoDivId)) {
            $this->infoDivId = 'tableconsole' . Handsontable::$table_created;
        }
        return $this->infoDivId;
    }

    protected function setInfoDivId($info_div_id) {
        $this->infoDivId = $info_div_id;
    }

    public function generateDivInfo() {
        return '<pre id="' . $this->getInfoDivId() . '"></pre>';
    }

    public function generateLoadButton() {
        return '<button name="' . $this->getLoadElementId() . '" id="' . $this->getLoadElementId() . '" >Load</button>';
    }

    public function generateSaveButton() {
        return '<button name="' . $this->getSaveElementId() . '" id="' . $this->getSaveElementId() . '" >Save</button>';
    }

    abstract public function loadJSLibraries();

    abstract public function loadCSSLibraries();

    public function renderJavascriptCode() {
        $js_code = $this->prepareInfo();
        $js_code.= $this->prepareContainer();
        if ($this->getSave()) {
            $js_code.= $this->prepareSave();
        }
        if ($this->getAutoSave()) {
            $js_code.= $this->prepareAutoSave();
        }
        if ($this->getLoadAction()) {
            $js_code.= $this->prepareLoad();
        }
        $js_code .= $this->generateTable();
        if ($this->getAutosave()) {
            $js_code.= ',' . PHP_EOL . $this->saveTableChangesFunctions();
        }
        $js_code.= PHP_EOL . ' });';
        if ($this->getSave()) {
            $js_code.= PHP_EOL . $this->saveTableFunctions();
        }
        if ($this->getLoadAction()) {
            $js_code.= $this->loadTable();
        }
        return $js_code;
    }

    public function generateTable() {
        $method_not_rendered = array('data', 'containername', 'loadlibrairy', 'loaddatasource',
            'infodivid', 'save', 'autosave', 'loadaction', 'savedatasource', 'loadelementid');


        $js_table_code = 'var hot' . Handsontable::$table_created . ' = new Handsontable(container, {';

        $class = new \ReflectionClass(__CLASS__);

        if (isset($this->data) && !is_null($this->data)) {
            $js_table_code .= 'data : ' . json_encode($this->data, JSON_PRETTY_PRINT) . ', ' . PHP_EOL;
        }
        foreach ($class->getMethods() as $method) {
            if (substr($method->name, 0, 3) == 'get') {
                $propName = strtolower(substr($method->name, 3, 1)) . substr($method->name, 4);

                if (!in_array(strtolower($propName), $method_not_rendered)) {
                    $result = $method->invoke($this);
                    if (!is_null($result)) {
                        if ($result instanceof \JsonSerializable) {
                            $js_table_code .= $propName . ' : ' . JsonExpression::buildJson(json_encode($result, JSON_PRETTY_PRINT)) . ', ' . PHP_EOL;
                        } else {
                            $js_table_code .= $propName . ' : ' . json_encode($result, JSON_PRETTY_PRINT) . ', ' . PHP_EOL;
                        }
                    }
                }
            }
        }
        // suppression de la dernière virgule
        $js_table_code[strrpos($js_table_code, ',')] = ' ';

//        if (isset($this->data) && !is_null($this->data)) {
//            $js_data_code = 'var data' . Handsontable::$table_created . '= ' . $this->getData();
//            $js_table_code = $js_data_code . PHP_EOL . $js_table_code;
//        }


        return $js_table_code;
//            startRows: 2,
//            startCols: 8,
//            width: 900,
//            height: 700,
//            rowHeaders: true,
//            autoWrapRow: true,
//            maxCols : 8,
//            colHeaders: [
//                'ID',
//                'Country',
//                'Code',
//                'Currency',
//                'Level',
//                'Units',
//                'Date',
//                'Change'
//            ]";
    }

    protected function prepareLoad() {
        return "var load = document.getElementById('" . $this->getLoadElementId() . "');" . PHP_EOL;
    }

    protected function prepareInfo() {
        return "var tableconsole = document.getElementById('" . $this->getInfoDivId() . "');" . PHP_EOL;
    }

    private function prepareAutoSave() {
        return "var autosaveNotification;" . PHP_EOL;
    }

    private function prepareSave() {
        return "var save = document.getElementById('" . $this->getSaveElementId() . "');" . PHP_EOL;
    }

    private function prepareContainer() {
        return "var  container =  document.getElementById('" . $this->getContainerName() . "');" . PHP_EOL;
    }

    function loadTable() {
        return "
         Handsontable.dom.addEvent(load, 'click', function() {
            $.ajax('" . $this->loadDataSource . "')
                .success(function (res) {
                    var data = JSON.parse(res);
                    hot" . Handsontable::$table_created . ".loadData(JSON.parse(data.data));
                    tableconsole.innerText = 'Data loaded';
                });
            });
        ";
    }

    public function saveTableChangesFunctions() {
        return "
        afterChange: function (change, source) {
          if (source === 'loadData') {
              return; //don't save this change
            }
            clearTimeout(autosaveNotification);
            console.log(change);
            $.ajax('" . $this->saveAutoSataSource . "',{
                 method: 'POST',
              data: {
                     tabledata : JSON.stringify({data: change}),
                 },
              success: function (data) {
                  tableconsole.innerText  = 'Autosaved (' + data.length + ' ' + 'cell' + (data.length > 1 ? 's' : '') + ')';
                  autosaveNotification = setTimeout(function() {
                  tableconsole.innerText ='Changes will be autosaved';
              }, 1000);
         
             }
          });
        }
   ";
    }

    protected function saveTableFunctions() {
        return " Handsontable.dom.addEvent(save, 'click', function() {
      // save all cell's data
      $.ajax('" . $this->saveDataSource . "',{
            method: 'POST',
            data: {
                 tabledata : JSON.stringify({data: hot" . Handsontable::$table_created . ".getData()}),
                },
            success: function (response) {
                var saved = JSON.parse(response);
                if (saved) {
                  tableconsole.innerText = 'Data saved';
                }
                else {
                  tableconsole.innerText = 'Save error';
                }
            }
        });    
    }); ";
    }

    abstract public function render();
}
