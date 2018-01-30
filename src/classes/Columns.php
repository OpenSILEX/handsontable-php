<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace openSILEX\handsontablePHP\classes;

use \openSILEX\handsontablePHP\tools\JavascriptFormatter;

/**
 * Description of Columns
 *
 * @author blue
 */
class Columns implements \JsonSerializable {

    protected $columns = null;

    /**
     * 
     * [
      {data: 0},
      {data: 2},
      {data: 3},
      {data: 4},
      {data: 5},
      {data: 6}
      ]
     * 
     * Représenté par [new ColumnConfig('data' => 0),new ColumnConfig('data' => 1),....]
     *  function (column){
     *   var columnMeta = {};

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
      }

      return columnMeta;
     * @param mixed $columns may be a function or an  array
     */
    public function __construct($columns) {
        $this->columns = $columns;
    }

    public function jsonSerialize() {
        if (is_array($this->columns)) {
            return $this->columns;
        }
        if ($this->columns instanceof \Closure) {
            $columnsFunction = $this->columns;
            return 'function(column){ ' .JavascriptFormatter::prepareJavascriptText($columnsFunction(),true) . '}';
        }
        return null;
    }

}
