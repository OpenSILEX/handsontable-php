<?php

//******************************************************************************
//                              Columns.php
//
// Author(s): Arnaud Charleroy
// SILEX version 1.0
// Copyright © - INRA - 2018
// Creation date: 26 janv. 2018
// Contact: arnaud.charleroy@inra.fr, anne.tireau@inra.fr, pascal.neveu@inra.fr
// Last modification date:  26 janv. 2018
// Subject: A class which represents Columns handsontable option
//******************************************************************************

/**
 * @link http://www.inra.fr/
 * @copyright Copyright © INRA - 2018
 * @license https://www.gnu.org/licenses/agpl-3.0.fr.html AGPL-3.0
 */

namespace openSILEX\handsontablePHP\classes;

use \openSILEX\handsontablePHP\tools\JavascriptFormatter;

/**
 * A class which represents Columns handsontable option
 * @author Arnaud Charleroy <arnaud.charleroy@inra.fr>
 * @since 1.0
 * @link https://docs.handsontable.com/latest/Options.html#columns
 */
class Columns implements \JsonSerializable {

    /**
     * @var mixed array of ColumnConfig instances or function javascript string
     */
    protected $columns = null;

    /**
     * @example the following array
     * columns : [
     * {data: 0},
     * {data: 2},
     * {data: 3},
     * {data: 4},
     * {data: 5},
     * {data: 6}
     * ]
     * is represented by :
     * $handsontable_instance->setColumns(
     * [new ColumnConfig('data' => 0),new ColumnConfig('data' => 1),....]
     * );
     *
     * Other parameters can be put :
     * $handsontable_instance->setColumns([
     * new ColumnConfig([
     * 'data' => 0,
     * 'type' => 'autocomplete',
     * 'source' => new AjaxSourceColumn('ajax/array.php')
     * ]);
     *
     * @example
     * a javascript function text function may be used instead of ColumnConfig instances
     * // php function
     * $handsontable_instance->setColumns(function(){
     *       return "var columnMeta = {};
     *
     *             if (column === 0) {
     *               columnMeta.data = 'id';
     *
     *             } else if (column === 1) {
     *               columnMeta.data = 'name.first';
     *
     *             } else if (column === 2) {
     *               columnMeta.data = 'name.last';
     *
     *
     *              } else if (column === 3) {
     *         columnMeta.data = 'address';
     *
     *          } else {
     *          columnMeta = null;
     *
     *         }
     *
     *         return columnMeta;";
     *    });
     *   A string 
     *  $handsontable_instance->setColumns(
     *       "var columnMeta = {};
     *
     *             if (column === 0) {
     *               columnMeta.data = 'id';
     *
     *             } else if (column === 1) {
     *               columnMeta.data = 'name.first';
     *
     *             } else if (column === 2) {
     *               columnMeta.data = 'name.last';
     *
     *
     *              } else if (column === 3) {
     *         columnMeta.data = 'address';
     *
     *          } else {
     *          columnMeta = null;
     *
     *         }
     *
     *         return columnMeta;";
     *    );
     * @param mixed $columns may be a function or an  array
     */
    public function __construct($columns) {
        $this->columns = $columns;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * Inherited from \JsonSerializable::jsonSerialize() method
     * @example columns : function(column){
     *             var columnMeta = {};
     *
     *             if (column === 0) {
     *               columnMeta.data = 'id';
     *
     *             } else if (column === 1) {
     *               columnMeta.data = 'name.first';
     *
     *             } else if (column === 2) {
     *               columnMeta.data = 'name.last';
     *
     *
     *              } else if (column === 3) {
     *         columnMeta.data = 'address';
     *
     *          } else {
     *          columnMeta = null;
     *
     *         }
     *
     *         return columnMeta;";
     * }
     * @example  columns : [
     *              {data: 0},
     *              {data: 2},
     *              {data: 3},
     *              {data: 4},
     *              {data: 5},
     *              {data: 6}
     *              ]
     * @return mixed data which can be serialized by <b>json_encode</b>
     */
    public function jsonSerialize() {
        // if array convert array in javascript format
        if (is_array($this->columns)) {
            return $this->columns;
        }
        // if is a string
        if (is_string($this->columns)) {
            $columnsString = $this->columns;
            return 'function(column){ ' . JavascriptFormatter::prepareJavascriptText($columnsString, true) . '}';
        }
        // if is a PHP function it return a string
        if ($this->columns instanceof \Closure) {
            $columnsFunction = $this->columns;
            return 'function(column){ ' . JavascriptFormatter::prepareJavascriptText($columnsFunction(), true) . '}';
        }
        return null;
    }

}
