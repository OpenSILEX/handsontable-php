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

use \openSILEX\handsontablePHP\tools\JavascriptFormatter;

/**
 * Represents cells configuration
 * @see https://docs.handsontable.com/0.35.1/Options.html#cells
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
            return 'function(row, col, prop){ ' . JavascriptFormatter::prepareJavascriptText($cellsConfigsFunction(),true) . '}';
        }
        return null;
    }

}
