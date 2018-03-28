<?php

//******************************************************************************
//                              CellsConfig.php
//
// Author(s): Arnaud Charleroy
// SILEX version 1.0
// Copyright © - INRA - 2018
// Creation date: 26 janv. 2018
// Contact: arnaud.charleroy@inra.fr, anne.tireau@inra.fr, pascal.neveu@inra.fr
// Last modification date:  26 janv. 2018
// Subject: A class which represents cells configuration
//******************************************************************************

/**
 * @link http://www.inra.fr/
 * @copyright Copyright © INRA - 2018
 * @license https://www.gnu.org/licenses/agpl-3.0.fr.html AGPL-3.0
 */

namespace openSILEX\handsontablePHP\classes;

use \openSILEX\handsontablePHP\classes\CellConfigDefinition;
use \openSILEX\handsontablePHP\tools\JavascriptFormatter;

/**
 * Represents a set of cell configuration unit or a function for cells configuration
 * @link https://docs.handsontable.com/latest/Options.html#cells
 * @link https://docs.handsontable.com/latest/Options.html#cell
 * @author Arnaud Charleroy <arnaud.charleroy@inra.fr>
 * @since 1.0
 */
class CellsConfig implements \JsonSerializable {

    /**
     * List of the cell definition that will be specified
     * @var mixed array of CellConfigDefinition or Closure object
     */
    protected $cellsConfig = null;

    /**
     * Define if the attribute is cell or cells
     * @var int number of the mode used
     */
    protected $cellMode = null;

    /**
     * Used to save information about cell attribute
     */
    const CELL_MODE = 0;

    /**
     * Used to save information about cells attribute
     */
    const CELLS_MODE = 1;
    
    /**
     * Value to put in cell or cells attribute which define global or
     * single cell configuration
     * @param mixed $cellsConfig array of openSILEX\handsontablePHP\classes\CellConfigDefinition
     *  in case of cells attribute or \Closure and string in case of cell attribute
     * @param int $cellMode for cell openSILEX\handsontablePHP\classes\CellsConfig::CELLS_MODE
     * or cells attribute openSILEX\handsontablePHP\classes\CellsConfig::CELLS_MODE
     */
    public function __construct($cellsConfig, $cellMode = CellsConfig::CELLS_MODE) {
        $this->cellsConfig = $cellsConfig;
        $this->cellMode = $cellMode;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * Inherited from \JsonSerializable::jsonSerialize() method
     * @example
     * cells: function (row, col, prop) {
     *      var cellProperties = {}
     *
     *      if (row === 0 && col === 0) {
     *       cellProperties.readOnly = true;
     *      }
     *
     *      return cellProperties;
     * }
     * @return mixed data which can be serialized by <b>json_encode</b>
     */
    public function jsonSerialize() {
        /**
         *  @link https://docs.handsontable.com/latest/Options.html#cells
         */
        if ($this->cellMode == CellsConfig::CELLS_MODE) {
            if ($this->cellsConfig instanceof \Closure) {
                $cellConfigsFunction = $this->cellsConfig;
                return 'function(row, col, prop){ ' . JavascriptFormatter::prepareJavascriptText($cellConfigsFunction(), true) . '}';
            }
        }
        
        if ($this->cellMode == CellsConfig::CELLS_MODE) {
            if (is_string($this->cellsConfig)) {
                $cellConfigsString = $this->cellsConfig;
                return 'function(row, col, prop){ ' . JavascriptFormatter::prepareJavascriptText($cellConfigsString, true) . '}';
            }
        }
        /**
         *  @link https://docs.handsontable.com/latest/Options.html#cell
         */
        if ($this->cellMode == CellsConfig::CELL_MODE) {
            if (is_array($this->cellsConfig)) {
                $temporaryCellsArray = [];
                foreach ($this->cellsConfig as $cell) {
                    if ($cell instanceof CellConfigDefinition) {
                        $temporaryCellsArray[] = $cell;
                    }
                }
                return $temporaryCellsArray;
            }
        }
        return null;
    }
}
