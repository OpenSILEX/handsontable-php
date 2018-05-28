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
 * Class which represents a column element in Columns handsontable option
 * @author Arnaud Charleroy <arnaud.charleroy@inra.fr>
 * @since 1.0
 * @see openSILEX\handsontablePHP\classes\Columns
 */
class ColumnConfig implements \JsonSerializable {

    /**
     *
     * @var array defines a column properties
     */
    protected $properties;

    public function __construct($properties = null) {
        $this->properties = $properties;
    }

    public function setProperty($name, $value) {
        // if properties not set
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

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * Inherited from \JsonSerializable::jsonSerialize() method
     * @example
     * columns: [
     * {},
     *  ...,
     * {data: 0},
     *  ...,
     *  {data: 'id'},
     *  ...,
     *  {
     *   type: 'autocomplete',
     *   source: function (query, process) {
     *    $.ajax({
     *      //url: 'php/cars.php', // commented out because our website is hosted as a set of static pages
     *      url: 'scripts/json/autocomplete.json',
     *      dataType: 'json',
     *      data: {
     *        query: query
     *      },
     *     success: function (response) {
     *        console.log("response", response);
     *        //process(JSON.parse(response.data)); // JSON.parse takes string as a argument
     *        process(response.data);
     *      }
     *    });
     *  }
     *  ]
     * @return mixed data which can be serialized by <b>json_encode</b>
     */
    public function jsonSerialize() {
        if (!isset($this->properties) || empty($this->properties)) {
            return '{}';
        }
        $newArray = JavascriptFormatter::preparePHPArrayToJSArray($this->properties);
        return $newArray;
    }
}
