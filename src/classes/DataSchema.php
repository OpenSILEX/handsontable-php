<?php

//******************************************************************************
//                              DataSchema.php
//
// Author(s): Arnaud Charleroy
// SILEX version 1.0
// Copyright © - INRA - 2018
// Creation date: 26 janv. 2018
// Contact: arnaud.charleroy@inra.fr, anne.tireau@inra.fr, pascal.neveu@inra.fr
// Last modification date:  26 janv. 2018
// Subject: A class which represents a dataschema in handsontable
//******************************************************************************

/**
 * @link http://www.inra.fr/
 * @copyright Copyright © INRA - 2018
 * @license https://www.gnu.org/licenses/agpl-3.0.fr.html AGPL-3.0
 */

namespace openSILEX\handsontablePHP\classes;

/**
 * Class which represents DataSchema handsontable option
 * @author Arnaud Charleroy <arnaud.charleroy@inra.fr>
 * @since 1.0
 * @link https://docs.handsontable.com/latest/Options.html#dataSchema
 */
class DataSchema implements \JsonSerializable {

    /**
     * @var array contains dataschema value
     */
    protected $schema = null;

    public function __construct($schema) {
        $this->schema = $schema;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * Inherited from \JsonSerializable::jsonSerialize() method
     * @example
     * dataSchema: {id: null, name: {first: null, last: null}, address: null},
     *
     * @return mixed data which can be serialized by <b>json_encode</b>
     */
    public function jsonSerialize() {
        return $this->schema;
    }
}
