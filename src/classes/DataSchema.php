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
 * @see https://docs.handsontable.com/latest/Options.html#dataSchema
 */
class DataSchema implements \JsonSerializable{
    /**
     * @var contains dataschema value 
     */
    protected $schema =null;
    
    public function __construct($schema) {
        $this->schema = $schema;
    }

    public function jsonSerialize() {
        return $this->schema;
    }

}
