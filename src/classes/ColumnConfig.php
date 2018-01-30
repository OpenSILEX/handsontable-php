<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace openSILEX\handsontablePHP\classes;

use openSILEX\handsontablePHP\tools\JavascriptFormatter;

/**
 * Description of Data
 *
 * @author blue
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
