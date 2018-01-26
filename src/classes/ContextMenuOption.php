<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace openSILEX\handsontablePHP\classes;

use \openSILEX\handsontablePHP\tools\JsonExpression;

/**
 * Description of contextMenuOption
 *
 * @author blue
 */
class ContextMenuOption implements \JsonSerializable {

    protected $key;
    protected $name;
    protected $disabled;
    protected $callback;

    function __construct($key, $name) {
        $this->key = $key;
        $this->name = $name;
    }

    function getKey() {
        return $this->key;
    }

    function getName() {
        return $this->name;
    }

    function getDisabled() {
        return $this->disabled;
    }

    function getCallback() {
        return $this->callback;
    }

    function setKey($key) {
        $this->key = $key;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDisabled(\Closure $disabled) {
        $this->disabled = $disabled;
    }

    function setCallback(\Closure $callback) {
        $this->callback = $callback;
    }

    public function jsonSerialize() {
        $js = "{
          key: '{$this->key}',"
                . "name: '{$this->name}'";
        if (isset($this->disabled) && !is_null($this->disabled)) {
            $disabledFunc = "disabled: function() { " .
                    $this->disabled
                    . " }";
            $js .= ',' .  JsonExpression::buildJson($disabledFunc);
        }
        if (isset($this->disabled) && !is_null($this->callback)) {
            $callbackFunc = "callback: function() { " .
                    $this->callback
                    . " }";
            $js .= ',' . JsonExpression::buildJson($callbackFunc);
        }
    }

}
