<?php

//******************************************************************************
//                              UpdateSettings.php
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
 * Class which represents a column element in Columns handsontable option
 * @author Arnaud Charleroy <arnaud.charleroy@inra.fr>
 * @since 1.0
 * @see openSILEX\handsontablePHP\classes\Columns
 */
class UpdateSettings implements \JsonSerializable {

    /**
     *
     * @var array defines a column properties
     */
    protected $properties;

    /**
     *
     * @var array defines a column properties
     */
    protected $handsontableVariableName;

    public function __construct($properties) {
        $this->properties = $properties;
    }
    
    /**
     * Set a property with her value
     * @param string $name property name
     * @param mixed $value property value
     */
    public function setProperty($name, $value) {
        // create properties array if not set
        if (!isset($this->properties)) {
            $this->properties = [];
        }
        $this->properties[$name] = $value;
    }

    public function setProperties($properties) {
        return $this->properties = $properties;
    }

    public function getProperties() {
        return $this->properties;
    }

    public function getHandsontableVariableName() {
        return $this->handsontableVariableName;
    }

    public function setHandsontableVariableName($handsontableVariableName) {
        $this->handsontableVariableName = $handsontableVariableName;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * Inherited from \JsonSerializable::jsonSerialize() method
     * @example
     * hot.updateSettings({
     *  columnSorting: false
     * });
     * @return mixed data which can be serialized by <b>json_encode</b>
     */
    public function jsonSerialize() {
        if (!isset($this->properties) || empty($this->properties)) {
            return '';
        }
        $newArray = JavascriptFormatter::preparePHPArrayToJSArray($this->properties);
        return "{$this->handsontableVariableName}.updateSettings( "
                . JavascriptFormatter::prepareJavascriptText(PHP_EOL . json_encode($newArray) . PHP_EOL)
                . ");";
    }
}
