<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace openSILEX\handsontablePHP\classes;

//use \openSILEX\handsontablePHP\tools\JsonExpression;
use \openSILEX\handsontablePHP\classes\CellConfigDefinition;

/**
 * Represents cell configuration
 * @see https://docs.handsontable.com/0.34.5/tutorial-setting-options.html
 *
 * @author blue
 */
class CellConfig implements \JsonSerializable {

    protected $cellsConfig = null;

    public function __construct($cellsConfig) {
        $this->cellsConfig = $cellsConfig;
    }

    /**
      cells: function (row, col, prop) {
      var cellProperties = {}

      if (row === 0 && col === 0) {
      cellProperties.readOnly = true;
      }

      return cellProperties;
      }
     */
    public function jsonSerialize() {
        if (is_array($this->cellsConfig)) {
            $tmpCellsArray = [];
            foreach ($this->cellsConfig as $cell) {
                if ($cell instanceof CellConfigDefinition) {
                    $tmpCellsArray[] = $cell;
                }
            }
            return $tmpCellsArray;
        }
//        if ($this->cellsConfig instanceof \Closure) {
//            $cellsConfigsFunction = $this->cellsConfig;
//            $functionJS = new JsonExpression($cellsConfigsFunction());
//            return 'function(row, col, prop){ ' . JsonExpression::buildJson($functionJS->getExpression()) . '}';
//        }
        return null;
    }

}
