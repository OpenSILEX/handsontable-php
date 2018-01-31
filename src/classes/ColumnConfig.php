<?php

//******************************************************************************
//                              ColumnConfig.php
//
// Author(s): Arnaud Charleroy
// SILEX version 1.0
// Copyright © - INRA - 2018
// Creation date: 26 janv. 2018
// Contact: arnaud.charleroy@inra.fr, anne.tireau@inra.fr, pascal.neveu@inra.fr
// Last modification date:  26 janv. 2018
// Subject: A class which represents a unique column of handsontable columns
//******************************************************************************

/**
 * @link http://www.inra.fr/
 * @copyright Copyright © INRA - 2018
 * @license https://www.gnu.org/licenses/agpl-3.0.fr.html AGPL-3.0
 */

namespace openSILEX\handsontablePHP\classes;

use openSILEX\handsontablePHP\tools\JavascriptFormatter;

/**
 * Class which represents Columns handsontable option 
 * @author Arnaud Charleroy <arnaud.charleroy@inra.fr>
 * @since 1.0
 */
class ColumnConfig implements \JsonSerializable {

    protected $properties;

    function __construct($properties = null) {
        $this->properties = $properties;
    }

    function setAttribute($attribute) {
        $this->attribute = $attribute;
    }

    function setValue($value) {
        $this->value = $value;
    }

    public function jsonSerialize() {
        if (!isset($this->properties) || empty($this->properties)) {
            return '{}';
        }
        $newArray = JavascriptFormatter::preparePHPArrayToJSArray($this->properties);
        return $newArray;
    }
    
  

}
