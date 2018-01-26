<?php


namespace inra\handsontable\classes;

use \inra\handsontable\tools\JsonExpression;

/**
 * Represents cells configuration
 * @see https://docs.handsontable.com/0.34.5/tutorial-setting-options.html
 *
 * @author blue
 */
class CellsConfig extends CellConfig {


    /**
     * @example  javscript_code cells: function (row, col, prop) {
        var cellProperties = {}

        if (row === 0 && col === 0) {
        cellProperties.readOnly = true;
        }
      return cellProperties;
      
     */
    public function jsonSerialize() {
        if ($this->cellsConfig instanceof \Closure) {
            $cellsConfigsFunction = $this->cellsConfig;
            $functionJS = new JsonExpression($cellsConfigsFunction());
            return 'function(row, col, prop){ ' . JsonExpression::buildJson($functionJS->getExpression()) . '}';
        }
        return null;
    }

}
