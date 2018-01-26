<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace openSILEX\handsontablePHP\classes;

/**
 * Description of dataSchema
 *
 * @author blue
 */
class DataSchema implements \JsonSerializable{
    protected $schema =null;
    
    public function __construct($schema) {
        $this->schema = $schema;
    }

    public function jsonSerialize() {
        return $this->schema;
    }

}
