<?php

//******************************************************************************
//                              JSFunction.php
//
// Author(s): Arnaud Charleroy
// SILEX version 1.0
// Copyright © - INRA - 2018
// Creation date: 02 feb. 2018
// Contact: arnaud.charleroy@inra.fr, anne.tireau@inra.fr, pascal.neveu@inra.fr
// Last modification date:  02 feb. 2018
// Subject: A class which represents a javascript function
//******************************************************************************

/**
 * @link http://www.inra.fr/
 * @copyright Copyright © INRA - 2018
 * @license https://www.gnu.org/licenses/agpl-3.0.fr.html AGPL-3.0
 */

namespace openSILEX\handsontablePHP\tools;

use \openSILEX\handsontablePHP\tools\JavascriptFormatter;

/**
 * Represents a javascript function
 * @author Arnaud Charleroy <arnaud.charleroy@inra.fr>
 * @since 1.0
 * @link https://docs.handsontable.com/latest/demo-autocomplete.html
 */
class JSFunction implements \JsonSerializable
{

    /**
     *
     * @var string js function
     */
    protected $function;

    public function __construct($function)
    {
        $this->function = $function;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * Inherited from \JsonSerializable::jsonSerialize() method
     * @example {
     *   function (query, process) {
     *     $.ajax({
     *       //url: 'php/cars.php', // commented out because our website is hosted as a set of static pages
     *       url: 'scripts/json/autocomplete.json',
     *       dataType: 'json',
     *       data: {
     *        query: query
     *      },
     *      success: function (response) {
     *        console.log("response", response);
     *         //process(JSON.parse(response.data)); // JSON.parse takes string as a argument
     *         process(response.data);
     *
     *       }
     *     });
     *
     *  @return mixed data which can be serialized by <b>json_encode</b>
     */
    public function jsonSerialize()
    {
        return JavascriptFormatter::prepareJavascriptText($this->function);
    }
}
