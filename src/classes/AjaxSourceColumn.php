<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace inra\handsontable\classes;

/**
 * Description of AjaxSourceColumn
 *
 * @author blue
 */
class AjaxSourceColumn implements \JsonSerializable{
    protected $url;
    protected $dataType;
    
    function __construct($url, $dataType = 'json') {
        $this->url = $url;
        $this->dataType = $dataType;
    }

    public function jsonSerialize() {
        return \inra\handsontable\tools\JsonExpression::buildJson("function (query, process) {
          $.ajax({
            url: '" . $this->url . "',
            dataType: '" . $this->dataType . "',
            data: {
              query: query
            },
            success: function (response) {
              console.log('response', response);
              process(response.data);
            }
          });
        }");
    }

}
