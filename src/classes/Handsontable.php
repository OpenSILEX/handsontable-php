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
use openSILEX\handsontablePHP\tools\JSFunction;

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
     * @var bool define if librairies need to be loaded or not
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
     * @var bool define if a save button will be created and if the function associated need to be generated
     */
    protected $save = false;

    /**
     *
     * @var bool iIf the table need to be saved at every modification or not
     */
    protected $autosave = false;

    /**
     *
     * @var bool define if a load button will be created and if the function associated need to be generated
     */
    protected $load = false;

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
    public static $createdTables = 0;

    /**
     *
     * @var string used to save js variable name
     */
    protected $jsVariableName;

    /**
     *
     * @var string used to generate data for examples
     */
    protected $spreadsheetDataHelper;

    /**
     *
     * @var array associative array of event
     */
    protected $events = [];

    /**
     *
     * @var array array of openSILEX\handsontablePHP\classes\CustomCellType
     */
    protected $customCells = [];

    /**
     *
     * @var openSILEX\handsontablePHP\classes\UpdateSettings define update settings
     */
    protected $updateSettings;

    // french langage is in a pull request at this time maybe soon
    // @link https://github.com/handsontable/handsontable/pull/4775
    //  const LANGUAGE_FRENCH = 'fr-FR';

    const LANGUAGE_POLISH = 'pl-PL  ';
    const LANGUAGE_ENGLISH = 'en-US';

    /**
     * ######################################
     * Handsontable JS library attributes
     * ######################################
     */

    /**
     * Overwrite configuration for a particular cell
     * @var array list of \openSILEX\handsontablePHP\classes\CellConfigDefinition
     * with \openSILEX\handsontablePHP\classes\CellConfig::MODE_CELL
     * @link https://docs.handsontable.com/0.35.1/Options.html#cell
     */
    protected $cell = null;

    /**
     * Defines the cell properties for given row, col, prop coordinates.
     * @var \Closure use of \openSILEX\handsontablePHP\classes\CellConfig
     * with \openSILEX\handsontablePHP\classes\CellConfig::MODE_CELLS
     * @link https://docs.handsontable.com/0.35.1/Options.html#cells
     */
    protected $cells = null;

    /**
     * Initial number of rows
     * @var int must be positive if not setted nothing will be done
     * @link https://docs.handsontable.com/0.35.1/Options.html#startRows
     */
    protected $startRows;

    /**
     * Initial number of columns
     * @var int must be positive if not setted nothing will be done
     * @link https://docs.handsontable.com/0.35.1/Options.html#startCols
     */
    protected $startCols;

    /**
     * Default data
     * @example $data = [
     * ['', 'Tesla', 'Nissan', 'Toyota', 'Honda', 'Mazda', 'Ford'],
     * ['2017', 10, 11, 12, 13, 15, 16],
     * ['2018', 10, 11, 12, 13, 15, 16],
     * ['2019', 10, 11, 12, 13, 15, 16],
     * ['2020', 10, 11, 12, 13, 15, 16],
     * ['2021', 10, 11, 12, 13, 15, 16]
     * ];
     *
     * @var array array of array of data (number,string ...)
     * @link https://docs.handsontable.com/0.35.1/Options.html#data
     */
    protected $data = null;

    /**
     * @var array array of \openSILEX\handsontablePHP\classes\ColumnConfig
     * Defines the cell properties and data binding for certain columns
     * @link https://docs.handsontable.com/0.35.1/Options.html#columns
     */
    protected $columns = null;

    /**
     * Width of the grid
     * Can be a number
     * //SILEX:notImplemented
     * or function that returns a value
     * //\SILEX:notImplemented
     * @var int Width of the grid
     * @link https://docs.handsontable.com/0.35.1/Options.html#width
     */
    protected $width = null;

    /**
     * Height of the grid.
     * Can be a number
     * //SILEX:notImplemented
     * or function that returns a value
     * //\SILEX:notImplemented
     * @var int Height of the grid
     * @link https://docs.handsontable.com/0.35.1/Options.html#height
     */
    protected $height = null;

    /**
     * Setting true or false will enable or disable the default row headers (1, 2, 3).
     * You can also define an array ['One', 'Two', 'Three', ...] or a function to define the headers.
     * @var mixed Defines handsontable row headers
     * @link https://docs.handsontable.com/0.35.1/Options.html#rowHeaders
     */
    protected $rowHeaders = true;

    /**
     * Setting true or false will enable or disable the default column headers (A, B, C).
     * You can also define an array ['One', 'Two', 'Three', ...] or a function to define the headers.
     * @var mixed Defines handsontable columns headers
     * @link https://docs.handsontable.com/0.35.1/Options.html#colHeaders
     */
    protected $colHeaders = true;

    /**
     * Defines the structure of a new row when data source is an array of objects
     * @var \openSILEX\handsontablePHP\classes\DataSchema represents the dataSchema object
     * @link https://docs.handsontable.com/0.35.1/Options.html#dataSchema
     */
    protected $dataSchema = null;

    /**
     * Defines if the right-click context menu should be enabled.
     * Possible values:
     * true (to enable default options),
     * false (to disable completely)
     * an array of predefined options,
     * //SILEX:notImplemented
     * an object with defined structure
     * //\SILEX:notImplemented
     * @var mixed multiple values
     * @link https://docs.handsontable.com/0.35.1/Options.html#contextMenu
     */
    protected $contextMenu = ['row_above', 'row_below', 'remove_row', 'undo', 'redo', 'copy', 'cut'];

    /**
     * If true, pressing TAB or right arrow in the last column will move to first column in next row.
     * @var bool autoWrapRow
     * @link https://docs.handsontable.com/0.35.1/Options.html#autoWrapRow
     */
    protected $autoWrapRow = true;

    /**
     * When set to 1 (or more), Handsontable will add a new row at the end of grid if there are no more empty rows.
     * @var int Add a new row at the end of grid
     * @link https://docs.handsontable.com/0.35.1/Options.html#minSpareRows
     */
    protected $minSpareRows = 1;

    /**
     * Maximum number of columns
     * @var int Define a limit of column number
     * @link https://docs.handsontable.com/0.35.1/Options.html#maxCols
     */
    protected $maxCols;

    /**
     * @var int Defines row heights in pixels.
     * //SILEX:notImplemented
     *  as string
     *  as array
     *  as function
     * //\SILEX:notImplemented
     * @link https://docs.handsontable.com/0.35.1/Options.html#rowHeights
     */
    protected $rowHeights;

    /**
     * @var int Defines columns heights in pixels
     * //SILEX:notImplemented
     *  as string
     *  as array
     *  as function
     * //\SILEX:notImplemented
     * @link https://docs.handsontable.com/0.35.1/Options.html#colWidths
     */
    protected $colWidths;

    /**
     * @var bool Set whether to display the current sorting order indicator
     * @link https://docs.handsontable.com/0.35.1/Options.html#sortIndicator
     */
    protected $sortIndicator = false;

    /**
     * @var bool To enable resizing on columns
     * /SILEX:notImplemented
     *  as array
     * //\SILEX:notImplemented
     * @link https://docs.handsontable.com/0.35.1/Options.html#manualColumnResize
     */
    protected $manualColumnResize = false;

    /**
     * @var bool To enable resizing on rows
     * * /SILEX:notImplemented
     *  as array
     * //\SILEX:notImplemented
     * @link https://docs.handsontable.com/0.35.1/Options.html#manualRowResize
     */
    protected $manualRowResize = false;

    /**
     * @var bool To enable freezing on columns
     * @link https://docs.handsontable.com/0.35.1/demo-freezing.html
     */
    protected $manualColumnFreeze = false;

    /**
     * @var int Number of fixed columns on left
     * @link https://docs.handsontable.com/0.35.1/demo-freezing.html
     */
    protected $fixedColumnsLeft;

    /**
     * @var int Number of fixed rows on top
     * @link https://docs.handsontable.com/0.35.1/demo-freezing.html
     */
    protected $fixedRowsTop;

    /**
     * @var string Define the table language use Handsontable::LANGUAGE_XXXXX define language
     * @link https://docs.handsontable.com/0.35.1/Options.html#language
     */
    protected $language = Handsontable::LANGUAGE_ENGLISH;

    /**
     * @param type $container_name represents the div tag id use by handsontable instance
     * If not set it will be automatically create
     * @param array $cellConfig represents the configuration of cells in a handsontable
     * instance (array of openSILEX\handsontablePHP\classe\CellConfigDefinition)
     * @link https://docs.handsontable.com/0.35.1/Options.html#cell     *
     */
    public function __construct($container_name = null, $cellConfig = null) {
        if ($cellConfig != null) { // load cell configuration
            $this->setCell($cellConfig);
        }
        if (is_null($container_name)) { // create handsontable instance if it doesn't exist
            $hash = new \DateTime();
            $this->containerName = 'handsontable' . Handsontable::$createdTables . md5($hash->getTimestamp());
        } else {
            $this->containerName = $container_name;
        }
        $this->jsVariableName = 'hot' . Handsontable::$createdTables;
        Handsontable::$createdTables++;
    }

    public function getContainerName() {
        return $this->containerName;
    }

    public function getLoadLibrairy() {
        return $this->loadLibrairy;
    }

    public function getLoadDataSource() {
        return $this->loadDataSource;
    }

    public function getSaveDataSource() {
        return $this->saveDataSource;
    }

    public function getSave() {
        return $this->save;
    }

    public function getAutosave() {
        return $this->autosave;
    }

    public function getLoad() {
        return $this->load;
    }

    public function getSaveElementId() {
        if (is_null($this->saveElementId)) {
            $this->saveElementId = 'save' . Handsontable::$createdTables;
        }
        return $this->saveElementId;
    }

    public function getStartRows() {
        return $this->startRows;
    }

    public function getStartCols() {
        return $this->startCols;
    }

    public function getWidth() {
        return $this->width;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getRowHeaders() {
        return $this->rowHeaders;
    }

    public function getColHeaders() {
        return $this->colHeaders;
    }

    /**
     * Possibly values :
     *
     * Implemented :
     * true (to enable default options),
     * false (to disable completely)
     * an array of predefined options,
     *
     * Not implemented :
     * an object with defined structure
     * @link https://docs.handsontable.com/0.35.1/Options.html#contextMenu
     *
     * @return mixed the contextMenu value
     */
    public function getContextMenu() {
        if (!is_array($this->contextMenu) && !is_bool($this->contextMenu)) {
            return false;
        }
        return $this->contextMenu;
    }

    public function getAutoWrapRow() {
        return $this->autoWrapRow;
    }

    public function getMaxCols() {
        return $this->maxCols;
    }

    public function getData() {
        return json_encode($this->data);
    }

    public function getDataSchema() {
        return $this->dataSchema;
    }

    public function getMinSpareRows() {
        return $this->minSpareRows;
    }

    public function getRowHeights() {
        // rowheights must be an array or an int
        if (!is_array($this->rowHeights) && !is_int($this->rowHeights)) {
            return null;
        }
        return $this->rowHeights;
    }

    public function getColWidths() {
        // colswidths must be an array or an int
        if (!is_array($this->colWidths) && !is_int($this->colWidths)) {
            return null;
        }
        return $this->colWidths;
    }

    public function getManualColumnResize() {
        return $this->manualColumnResize;
    }

    public function getManualRowResize() {
        return $this->manualRowResize;
    }

    public function getSortIndicator() {
        return $this->sortIndicator;
    }

    public function getFixedColumnsLeft() {
        return $this->fixedColumnsLeft;
    }

    public function getFixedRowsTop() {
        return $this->fixedRowsTop;
    }

    public function getLanguage() {
        return $this->language;
    }

    public function getColumns() {
        return $this->columns;
    }

    public function getCell() {
        return $this->cell;
    }

    public function getCells() {
        return $this->cells;
    }

    public function getManualColumnFreeze() {
        return $this->manualColumnFreeze;
    }

    /**
     * Create a example set
     * @param int $rowNumber number of rows that need to be created
     * @param int $columnNumber number of columns that need to be created
     */
    public function generateSpreadsheetDataHelper($rowNumber, $columnNumber) {
        $this->spreadsheetDataHelper = "var myData" . Handsontable::$createdTables . " = Handsontable.helper.createSpreadsheetData({$rowNumber}, {$columnNumber})";
    }

    public function getJsVariableName() {
        return $this->jsVariableName;
    }

    public function setManualColumnFreeze(bool $manualColumnFreeze) {
        // context menu must be set on before activate manual columnFreeze
        if ($manualColumnFreeze) {
            $contextMenu = $this->getContextMenu();
            // activation of context menu
            if (isset($contextMenu) && is_array($contextMenu)) {
                if (!in_array("freeze_column", $contextMenu)) {
                    $contextMenu[] = "freeze_column";
                }
                if (!in_array("unfreeze_column", $contextMenu)) {
                    $contextMenu[] = "unfreeze_column";
                }
                $this->contextMenu = $contextMenu;
            }
            // if is not an array set it true
            if (!isset($contextMenu) || $contextMenu === false) {
                $this->contextMenu = true;
            }
        }
        $this->manualColumnFreeze = $manualColumnFreeze;
    }

    public function setFixedColumnsLeft($fixedColumnsLeft) {
        $this->fixedColumnsLeft = $fixedColumnsLeft;
    }

    public function setFixedRowsTop($fixedRowsTop) {
        $this->fixedRowsTop = $fixedRowsTop;
    }

    public function setLanguage($language) {
        $this->language = $language;
    }

    public function setSortIndicator(bool $sortIndicator) {
        $this->sortIndicator = $sortIndicator;
    }

    public function setRowHeights($rowHeights) {
        $this->rowHeights = $rowHeights;
    }

    public function setColWidths($colWidths) {
        $this->colWidths = $colWidths;
    }

    public function setManualColumnResize(bool $manualColumnResize) {
        $this->manualColumnResize = $manualColumnResize;
    }

    public function setManualRowResize(bool $manualRowResize) {
        $this->manualRowResize = $manualRowResize;
    }

    public function setMinSpareRows($minSpareRows) {
        $this->minSpareRows = $minSpareRows;
    }

    public function setDataSchema(\openSILEX\handsontablePHP\classes\DataSchema $dataSchema) {
        $this->dataSchema = $dataSchema;
    }

    public function setData(array $data) {
        $this->data = $data;
    }

    public function setContainerName($containerName) {
        $this->containerName = $containerName;
    }

    public function setLoadLibrairy($loadLibrairy) {
        $this->loadLibrairy = $loadLibrairy;
    }

    public function setAutosave($autosave) {
        $this->autosave = $autosave;
    }

    public function setSaveElementId($saveElementId) {
        $this->saveElementId = $saveElementId;
    }

    public function setStartRows($startRows) {
        $this->startRows = $startRows;
    }

    public function setStartCols($startCols) {
        $this->startCols = $startCols;
    }

    public function setWidth($width) {
        $this->width = $width;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function setRowHeaders($rowHeaders) {
        $this->rowHeaders = $rowHeaders;
    }

    /**
     *
     * @param string $saveDataSource path to save json
     */
    public function setSaveAction($saveDataSource) {
        $this->save = true;
        $this->saveDataSource = $saveDataSource;
    }

    /**
     *
     * @param string $loadDataSource path to load json
     */
    public function setLoadAction($loadDataSource) {
        $this->load = true;
        $this->loadDataSource = $loadDataSource;
    }

    /**
     * Possibly values :
     * Implemented
     * Setting true or false will enable or disable the default column headers (A, B, C).
     * You can also define an array ['One', 'Two', 'Three', ...]
     * Not Implemented
     * or a function to define the headers.
     * @link https://docs.handsontable.com/0.35.1/Options.html#colHeaders
     *
     * @return mixed colHeaders value
     */
    public function setColHeaders($colHeaders) {
        if (!is_array($this->colHeaders) && !is_bool($this->colHeaders)) {
            return true; // default value
        }
        $this->colHeaders = $colHeaders;
    }

    public function setContextMenu($contextMenu) {
        $this->contextMenu = $contextMenu;
    }

    public function setAutoWrapRow($autoWrapRow) {
        $this->autoWrapRow = $autoWrapRow;
    }

    public function setMaxCols($maxCols) {
        $this->maxCols = $maxCols;
    }

    /**
     *
     * @param string|\Closure $cells represents the cascading handsontable cell configuration
     * For more information look at the link
     * @link https://docs.handsontable.com/0.35.1/tutorial-setting-options.html
     */
    public function setCells($cells) {
        $this->cells = new CellsConfig($cells, CellsConfig::CELLS_MODE);
    }

    /**
     *
     * @param array $cell represent array of cell config
     * For more information look at the link
     * @link https://docs.handsontable.com/0.35.1/tutorial-setting-options.html
     */
    public function setCell(array $cell) {
        $this->cell = new CellsConfig($cell, CellsConfig::CELL_MODE);
    }

    public function setColumns($columns) {
        $this->columns = new Columns($columns);
    }

    public static function setTable_created($table_created) {
        self::$createdTables = $table_created;
    }

    public function getLoadElementId() {
        if (is_null($this->loadElementId)) {
            $this->loadElementId = "load" . Handsontable::$createdTables;
        }
        return $this->loadElementId;
    }

    public function setLoadElementId($load_element_id) {
        $this->loadElementId = $load_element_id;
    }

    public function getEvents() {
        return $this->events;
    }

    public function getCustomCells() {
        return $this->customCells;
    }

    /**
     *
     * @return null|openSILEX\handsontablePHP\classes\UpdateSettings
     */
    public function getUpdateSettings() {
        return $this->updateSettings;
    }

    public function setEvents($events) {
        $this->events = $events;
    }

    public function setCustomCells($customCells) {
        $this->customCells = $customCells;
    }

    /**
     *
     * @param \openSILEX\handsontablePHP\classes\UpdateSettings $updateSettings must be an instance of UpdateSettings
     */
    public function setUpdateSettings(\openSILEX\handsontablePHP\classes\UpdateSettings $updateSettings) {
        $updateSettings->setHandsontableVariableName($this->jsVariableName);
        $this->updateSettings = $updateSettings;
    }

    protected function getInfoDivId() {
        if (is_null($this->infoDivId)) {
            $this->infoDivId = "tableconsole" . Handsontable::$createdTables;
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
        // Need to be more generic, maybe only get element id and implement own button
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
        // Need to be more generic, maybe only get element id and implement own button
        //\SILEX:conception
        return '<button name="' . $this->getSaveElementId() . '" id="' . $this->getSaveElementId() . '" >Save</button>';
    }

    /**
     * This method permits to implement framework specific ways to load Handsontable and JQuery javascript librairies
     *
     * @return void|mixed It is defined by the developper
     */
    abstract public function loadJSLibraries($jquery = false, $librairiesPath = []);

    /**
     * This method permits to implement framework specific ways to load Handsontable and JQuery css librairies
     *
     * @return void|mixed It is defined by the developper
     */
    abstract public function loadCSSLibraries($jquery = false, $librairiesPath = []);

    /**
     * Generate javascript text to write in a web page in order to render a handsontable instance
     *
     * @return string javascript text generated
     */
    public function generateJavascriptCode() {
        $js_code = $this->prepareInfo();
        $js_code .= $this->prepareContainer();
        if ($this->getSave()) { // if a table need to be saved
            $js_code .= $this->prepareSave();
        }
        if (isset($this->spreadsheetDataHelper)) {
            $js_code .= $this->spreadsheetDataHelper . PHP_EOL;
        }
        if ($this->getAutoSave()) { // if a table need to be saved automatically
            $js_code .= $this->prepareAutoSave();
        }
        if ($this->getLoad()) { // if a table need to be loaded
            $js_code .= $this->prepareLoad();
        }
        if (isset($this->events) && !empty($this->events)) {
            foreach ($this->events as $eventName => $event) {
                $js_code .= PHP_EOL . $event;
            }
        }
        $js_code .= PHP_EOL . $this->generateTableJSCode();
        if ($this->getAutosave()) { // generate autosave custom functions
            $js_code .= "," . PHP_EOL . $this->saveTableChangesFunctions();
        }
        $js_code .= PHP_EOL . " });" . PHP_EOL;
        if ($this->getSave()) { // generate save custom functions
            $js_code .= PHP_EOL . $this->saveTableFunctions();
        }
        if ($this->getLoad()) { // generate load custom functions
            $js_code .= PHP_EOL . $this->loadTable();
        }

        if (isset($this->updateSettings)) { // generate updateSettings
            $js_code .= PHP_EOL . $this->updateSettings->jsonSerialize();
        }
        return $js_code;
    }

    /**
     * Method which generate the javascript table code needed
     * @example var hot1 = new Handsontable(
     *  container, {
     * data: data(),
     * startRows: 2,
     * startCols: 8,
     * width: 900,
     * height: 700,
     * rowHeaders: true,
     * autoWrapRow: true,
     * maxCols : 8,
     * colHeaders: [
     *  'ID',
     *  'Country',
     *  'Code',
     *  'Currency',
     *  'Level',
     *  'Units',
     *  'Date',
     *  'Change'
     *  ]";
     * });
     * @link http://jsfiddle.net/handsoncode/s6t768pq/
     *
     * @return string handsontable javascript text
     */
    public function generateTableJSCode() {
        // internal class attributes which will not rendered (must be in lowercase)
        $method_not_rendered = array(
            "data", "containername", "loadlibrairy", "loaddatasource",
            "infodivid", "save", "autosave", "load", "savedatasource",
            "loadelementid", "saveelementid", "spreadsheetdatahelper",
            "createdtables", "events", "customcells", "updatesettings",
            "jsvariablename"
        );
        //SILEX:conception
        // It's easier to remove getMethod for attribute that will not be rendered but some
        // attribute need to be modified before be retreived
        //SILEx:conception
        // javascript handsontable variable
        $js_table_code = "var {$this->jsVariableName} = new Handsontable(container, {";

        // this instance
        $handsontable_reflection_class = new \ReflectionClass(__CLASS__);

        // if data is set (not ajax or pre data)
        if (isset($this->data) && !is_null($this->data)) {
            $js_table_code .= "data : " . json_encode($this->data, JSON_PRETTY_PRINT) . ", " . PHP_EOL;
        } else {
            // if example data
            if (isset($this->spreadsheetDataHelper) && !is_null($this->spreadsheetDataHelper)) {
                $js_table_code .= "data : myData" . Handsontable::$createdTables . ", " . PHP_EOL;
            }
        }

        // Loop over this class attributes
        foreach ($handsontable_reflection_class->getMethods() as $method) {
            // only use get method
            if (substr($method->name, 0, 3) == "get") {
                $propName = strtolower(substr($method->name, 3, 1)) . substr($method->name, 4);
                // if it an allowed method
                if (!in_array(strtolower($propName), $method_not_rendered)) {
                    // incoke get method
                    $result = $method->invoke($this);
                    if (!is_null($result)) {
                        // If a specific serialization is defined
                        if ($result instanceof \JsonSerializable) {
                            $js_table_code .= $propName . " : " . JavascriptFormatter::prepareJavascriptText(json_encode($result, JSON_PRETTY_PRINT)) . ', ' . PHP_EOL;
                        } else {
                            $js_table_code .= $propName . " : " . json_encode($result, JSON_PRETTY_PRINT) . ", " . PHP_EOL;
                        }
                    }
                }
            }
        }
        // remove the last comma
        $js_table_code[strrpos($js_table_code, ",")] = " ";

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
    public function loadTable() {
        return "
         Handsontable.dom.addEvent(load, 'click', function() {
            $.ajax('" . $this->loadDataSource . "')
                .done(function (res) {
                    var data = JSON.parse(res);
                    {$this->jsVariableName}.loadData(data.data);
                    console.log('{$this->jsVariableName} Data loaded');
                }).fail(function() {
                    alert( '{$this->jsVariableName} Data not loaded' );
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
                 tabledata : JSON.stringify({data: {$this->jsVariableName}.getData()}),
                },
            success: function (response) {
                var saved = JSON.parse(response);
                if (saved) {
                  console.log('{$this->jsVariableName} Data saved');
                }
                else {
                 alert('{$this->jsVariableName} Save error');
                }
            }
        });    
    }); ";
    }

    /**
     *
     * @return string div container with handsontable scripts
     */
    public function generateContainerHTScript() {
        return "
        <div id='{$this->getContainerName()}'>
        </div>
        <script>
           {$this->generateJavascriptCode()}
        </script>";
    }

    /**
     *
     * @return string div container with handsontable scripts and other needed css and scripts links
     */
    public function generateLibrairyContainerHTScript($jquery = false, $libraries = []) {
        return "
        <div id='{$this->getContainerName()}'>
        </div>
        {$this->loadCSSLibraries($jquery, $libraries)}
        {$this->loadJSLibraries($jquery, $libraries)}
        <script>
           {$this->generateJavascriptCode()}
        </script>";
    }

    /**
     * Method which permits to render the table js (pattern adapter used) regardless of the framework used.
     * Need to defined a class per framework (Zend,Yii2,Laravel,CodeIgniter ...) and use HandsontableSimple for a native PHP usage.
     * Look at the see tags for example.
     * @see \openSILEX\handsontablePHP\adapter\HandsontableZend
     * @see \openSILEX\handsontablePHP\adapter\HandsontableSimple
     */
    abstract public function render();

    /**
     * If columns renderer option is date it permits to load automatically needed pikaday and moment js library
     * @return boolean
     */
    protected function ifDateRendererSetInColumns() {
        // if set columns
        if (isset($this->columns) && $this->columns instanceof \openSILEX\handsontablePHP\classes\Columns) {
            $columns = $this->getColumns()->getColumns();
            // for each columns
            foreach ($columns as $column) {
                $properties = $column->getProperties();
                // if date is set in "date' in "renderer" column properties it returns true otherwise it returns false
                if (isset($properties) && isset($properties['renderer'])) {
                    if ($properties['renderer'] === 'date') {
                        return true;
                    }
                }
                // if date is set 'date' in "type" column properties it returns true otherwise it returns false
                if (isset($properties) && isset($properties['type'])) {
                    if ($properties['type'] === 'date') {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Add Handsontable dom event (not working for now)
     * @param string $destinationContainerId
     * @param string $eventName
     * @param string $eventFunction
     * @todo need to be test it's not working
     */
    public function addEvent($destinationContainerId, $eventName, $eventFunction) {
        $eventJSFunction = new JSFunction($eventFunction);
        $event = "var $destinationContainerId{$this->jsVariableName} = document.getElementById('$destinationContainerId');" . PHP_EOL;
        $event .= "document.dom.addEvent($destinationContainerId{$this->jsVariableName}, '{$eventName}', function () { " . PHP_EOL
                . " {$eventJSFunction->jsonSerialize()} " . PHP_EOL
                . "});";
        $this->events[$eventName] = $event;
    }

    /**
     * Register custom cell type
     * @param \openSILEX\handsontablePHP\classes\CustomCellType $customCell
     */
    public function addCustomCellType(\openSILEX\handsontablePHP\classes\CustomCellType $customCell) {
        $this->customCells[$customCell->getName()] = $customCell;
    }

    /**
     *
     * @param type $eventName event name
     */
    public function removeEvent($eventName) {
        if (!empty($this->events) && isset($this->events[$eventName])) {
            unset($this->events[$eventName]);
        }
    }

    /**
     *
     * @param type $customCellName cell name
     */
    public function removeCustomCellType($customCellName) {
        if (!empty($this->customCells) && isset($this->customCells[$customCellName])) {
            unset($this->customCells[$customCellName]);
        }
    }
}
