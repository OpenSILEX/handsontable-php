<?php

//******************************************************************************
//                              AjaxSourceColumn.php
//
// Author(s): Arnaud Charleroy
// SILEX version 1.0
// Copyright © - INRA - 2018
// Creation date: 02 feb. 2018
// Contact: arnaud.charleroy@inra.fr, anne.tireau@inra.fr, pascal.neveu@inra.fr
// Last modification date:  02 feb. 2018
// Subject: A class which represents a dataschema in handsontable
//******************************************************************************

/**
 * @link http://www.inra.fr/
 * @copyright Copyright © INRA - 2018
 * @license https://www.gnu.org/licenses/agpl-3.0.fr.html AGPL-3.0
 */

namespace openSILEX\handsontablePHP\classes;

/**
 * Represents ajax source data
 * @author Arnaud Charleroy <arnaud.charleroy@inra.fr>
 * @since 1.0
 * @see https://docs.handsontable.com/latest/demo-autocomplete.html
 */
class AjaxSourceColumn implements \JsonSerializable
{

    /**
     *
     * @var string datasource url or path
     */
    protected $url;

    /**
     *
     * @var string returned data type
     */
    protected $dataType;

    /**
     *
     * @var boolean if data need to be showed in browser console
     */
    protected $debug;

    public function __construct($url, $dataType = 'json', $debug = false)
    {
        $this->url = $url;
        $this->dataType = $dataType;
        $this->debug = $debug;
    }

    /**
     * @example {
     *   type: 'autocomplete',
     *   source: function (query, process) {
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
     *   }
     *
     * @return string json text
     */
    public function jsonSerialize()
    {
        return \openSILEX\handsontablePHP\tools\JavascriptFormatter::prepareJavascriptText("function (query, process) {
          $.ajax({
            url: '" . $this->url . "',
            dataType: '" . $this->dataType . "',
            data: {
              query: query
            },
            success: function (response) {
              " . ($this->debug) ? "console.log('response', response);" : "" . "
              process(response.data);
            }
          });
        }");
    }
}
