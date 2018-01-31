<?php

//******************************************************************************
//                              Handsontable.php
//
// Author(s): Arnaud Charleroy
// SILEX version 1.0
// Copyright © - INRA - 2018
// Creation date: 26 janv. 2018
// Contact: arnaud.charleroy@inra.fr, anne.tireau@inra.fr, pascal.neveu@inra.fr
// Last modification date:  26 janv. 2018
// Subject: A class which represents a spreadsheet table
//******************************************************************************

/**
 * @link http://www.inra.fr/
 * @copyright Copyright © INRA - 2018
 * @license https://www.gnu.org/licenses/agpl-3.0.fr.html AGPL-3.0
 */

namespace openSILEX\handsontablePHP\classes;

use openSILEX\handsontablePHP\tools\JavascriptFormatter;
use openSILEX\handsontablePHP\classes\Columns;
use openSILEX\handsontablePHP\classes\CellsConfig;
use openSILEX\handsontablePHP\classes\CellConfig;

/**
 * Handsontable class represents a spreadsheet table
 * @author Arnaud Charleroy <arnaud.charleroy@inra.fr>
 * @since 1.0
 */
abstract class Handsontable {

    /**
     *
     * @var string id of the div container
     */
    protected $containerName;

    /**
     *
     * @var boolean define if librairies need to be loaded or not 
     */
    protected $loadLibrairy = true;

    /**
     *
     * @var string the path to the datasource or script which will load json data in the table
     * Example : 'ajax/data.php' or  'data.json'
     */
    protected $loadDataSource;

    /**
     *
     * @var string the path to the script which will save table data in json
     * Example : 'ajax/data.php' 
     */
    protected $saveDataSource;

    /**
     *
     * @var string id of the div which will give you information about the table
     */
    protected $infoDivId;

    /**
     *
     * @var boolean define if a save button will be created and if the function associated need to be generated
     */
    protected $save = false;

    /**
     * 
     * @var boolean iIf the table need to be saved at every modification or not
     */
    protected $autosave = false;

    /**
     *
     * @var boolean define if a load button will be created and if the function associated need to be generated
     */
    protected $loadAction = false;

    /**
     *
     * @var string id of the load div element
     */
    protected $loadElementId;

    /**
     *
     * @var string id of the save div element
     */
    protected $saveElementId;

    /**
     *
     * @var int number of handsontable instance created
     */
    public static $table_created = 0;
    // Handsontable JS library attributes
    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#cell
     */
    protected $cell = null;

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#cells
     */
    protected $cells = null;

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#startRows
     */
    protected $startRows;

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#startCols
     */
    protected $startCols;

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#data
     */
    protected $data = null;

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#columns
     */
    protected $columns = null;

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#width
     */
    protected $width = null;

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#height
     */
    protected $height = null;

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#rowHeaders
     */
    protected $rowHeaders = true;

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#colHeaders
     */
    protected $colHeaders = true;

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#dataSchema
     */
    protected $dataSchema = null;

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#contextMenu
     */
    protected $contextMenu = ['row_above', 'row_below', 'remove_row', 'undo', 'redo', 'copy', 'cut'];

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#autoWrapRow
     */
    protected $autoWrapRow = true;

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#minSpareRows
     */
    protected $minSpareRows = 1;

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#maxCols
     */
    protected $maxCols;

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#rowHeights
     */
    protected $rowHeights;

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#colWidths
     */
    protected $colWidths;

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#sortIndicator
     */
    protected $sortIndicator = false;

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#manualColumnResize
     */
    protected $manualColumnResize = false;

    /**
     * 
     * @see https://docs.handsontable.com/latest/Options.html#manualRowResize
     */
    protected $manualRowResize = false;

    public function __construct($container_name = null, $cellConfig = null) {
        if ($cellConfig != null) { // load cell configuration
            $this->cell = $cellConfig;
        }
        if (is_null($container_name)) { // create handsontable instance if it doesn't exist
            $this->containerName = 'handsontable' . Handsontable::$table_created;
            Handsontable::$table_created++;
        } else {
            $this->containerName = $container_name;
        }
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

    /**
    * Generate an html load button to trigger a handsontable from ajax source
    * 
    * @return string javascript text generated
    */
    public function generateLoadButton() {
        //SILEX:conception
        // Need to be more generic
        //\SILEX:conception
        return '<button name="' . $this->getLoadElementId() . '" id="' . $this->getLoadElementId() . '" >Load</button>';
    }
    
    /**
    * Generate an html load button to trigger a handsontable from ajax source
    * 
    * @return string javascript text generated
    */
    public function generateSaveButton() {
        //SILEX:conception
        // Need to be more generic
        //\SILEX:conception
        return '<button name="' . $this->getSaveElementId() . '" id="' . $this->getSaveElementId() . '" >Save</button>';
    }

    /**
     * This method permits to implement framework specific ways to load Handsontable and JQuery javascript librairies
     */
    abstract public function loadJSLibraries();

    /**
     * This method permits to implement framework specific ways to load Handsontable and JQuery css librairies
     */
    abstract public function loadCSSLibraries();

    /**
     * Generate javascript text to write in a web page in order to render a handsontable instance
     * 
     * @return string javascript text generated
     */
    public function generateJavascriptCode() {
        $js_code = $this->prepareInfo();
        $js_code.= $this->prepareContainer();
        if ($this->getSave()) { // if a table need to be saved
            $js_code.= $this->prepareSave();
        }
        if ($this->getAutoSave()) { // if a table need to be saved automatically
            $js_code.= $this->prepareAutoSave();
        }
        if ($this->getLoadAction()) { // if a table need to be loaded
            $js_code.= $this->prepareLoad();
        }
        $js_code .= $this->generateTableJSCode();
        if ($this->getAutosave()) { // generate autosave custom functions
            $js_code.= ',' . PHP_EOL . $this->saveTableChangesFunctions();
        }
        $js_code.= PHP_EOL . ' });';
        if ($this->getSave()) { // generate save custom functions
            $js_code.= PHP_EOL . $this->saveTableFunctions();
        }
        if ($this->getLoadAction()) { // generate load custom functions
            $js_code.= $this->loadTable();
        }
        return $js_code;
    }
    
    /**
     * Method which generate the javascript table code needed
     * @example var hot1 = new Handsontable(container, {
                    data: data(),
                    startRows: 2,
                    startCols: 8,
                    width: 900,
                    height: 700,
                    rowHeaders: true,
                    autoWrapRow: true,
                    maxCols : 8,
                    colHeaders: [
                        'ID',
                        'Country',
                        'Code',
                        'Currency',
                        'Level',
                        'Units',
                        'Date',
                        'Change'
                    ]";
        });
     * @see http://jsfiddle.net/handsoncode/s6t768pq/
     * 
     * @return string handsontable javascript text 
     */
    public function generateTableJSCode() {
        // class attributes which will not rendered
        $method_not_rendered = array('data', 'containername', 'loadlibrairy', 'loaddatasource',
            'infodivid', 'save', 'autosave', 'loadaction', 'savedatasource', 'loadelementid');
        // javascript handsontable variable
        $js_table_code = 'var hot' . Handsontable::$table_created . ' = new Handsontable(container, {';
        
        // this instance
        $handsontable_reflection_class = new \ReflectionClass(__CLASS__);
        
        // if data is set (not ajax or pre data)
        if (isset($this->data) && !is_null($this->data)) {
            $js_table_code .= 'data : ' . json_encode($this->data, JSON_PRETTY_PRINT) . ', ' . PHP_EOL;
        }
        // Loop over this class attributes
        foreach ($handsontable_reflection_class->getMethods() as $method) {
            // only use get method
            if (substr($method->name, 0, 3) == 'get') {
                $propName = strtolower(substr($method->name, 3, 1)) . substr($method->name, 4);
                // if it an allowed method
                if (!in_array(strtolower($propName), $method_not_rendered)) {
                    // incoke get method
                    $result = $method->invoke($this);
                    if (!is_null($result)) {
                        // If a specific serialization is defined
                        if ($result instanceof \JsonSerializable) {
                            $js_table_code .= $propName . ' : ' . JavascriptFormatter::prepareJavascriptText(json_encode($result, JSON_PRETTY_PRINT)) . ', ' . PHP_EOL;
                        } else {
                            $js_table_code .= $propName . ' : ' . json_encode($result, JSON_PRETTY_PRINT) . ', ' . PHP_EOL;
                        }
                    }
                }
            }
        }
        // remove th last comma
        $js_table_code[strrpos($js_table_code, ',')] = ' ';
        
        return $js_table_code;
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

    /**
     * Generate an event to load a handsontable from ajax source
     * 
     * @return string javascript text generated
     */
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

    /**
     * Generate afterChange handsontable javascript part
     * 
     * @return string javascript text generated
     */
    public function saveTableChangesFunctions() {
        //SILEX:conception
        // Need to be more generic
        //\SILEX:conception
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
    /**
     * Generate an event to save a handsontable to ajax source
     * 
     * @return string javascript text generated
     */
    protected function saveTableFunctions() {
        //SILEX:conception
        // Need to be more generic
        //\SILEX:conception
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
    
    /**
     * Method which permits to render the table (pattern adapter used) regardless of the framework used.
     * Need to defined a class per framework (Zend,Yii2,Laravel,CodeIgniter ...) and use HandsontableSimple for a native PHP usage.
     * Look at the see tags for example.
     * @see HandsontableZend
     * @see HandsontableSimple
     */
    abstract public function render();
}
