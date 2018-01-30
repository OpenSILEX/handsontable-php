<?php

namespace openSILEX\handsontablePHP\classes;

//******************************************************************************
//                              AjaxSourceColumn.php
//
// Author(s): Arnaud Charleroy
// SILEX version 1.0
// Copyright © - INRA - 2018
// Creation date: 26 janv. 2018
// Contact: arnaud.charleroy@inra.fr, anne.tireau@inra.fr, pascal.neveu@inra.fr
// Last modification date:  26 janv. 2018
// Subject: A class to retreive handsontable JS needed librairies
//******************************************************************************

class AjaxSourceColumn implements \JsonSerializable{
    /**
     *
     * @var string  datasource url or path
     */
    protected $url;
    /**
     *
     * @var string returned data type
     */
    protected $dataType;
    
    /**
     *
     * @var boolean if data need to be show in browser console
     */
    protected $debug;
    
    function __construct($url, $dataType = 'json' , $debug = false) {
        $this->url = $url;
        $this->dataType = $dataType;
        $this->debug = $debug;
    }

    public function jsonSerialize() {
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
