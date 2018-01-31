<?php

//******************************************************************************
//                              ContextMenuOption.php
//
// Author(s): Arnaud Charleroy
// SILEX version 1.0
// Copyright © - INRA - 2018
// Creation date: 26 janv. 2018
// Contact: arnaud.charleroy@inra.fr, anne.tireau@inra.fr, pascal.neveu@inra.fr
// Last modification date:  26 janv. 2018
// Subject: A class which represents a ContextMenu handsontable option
//******************************************************************************

/**
 * @link http://www.inra.fr/
 * @copyright Copyright © INRA - 2018
 * @license https://www.gnu.org/licenses/agpl-3.0.fr.html AGPL-3.0
 */

namespace openSILEX\handsontablePHP\classes;

use \openSILEX\handsontablePHP\tools\JavascriptFormatter;

/**
 * Class which represents ContextMenu handsontable option 
 * @author Arnaud Charleroy <arnaud.charleroy@inra.fr>
 * @since 1.0
 * @see https://docs.handsontable.com/latest/demo-context-menu.html#page-default
 */
class ContextMenuOption implements \JsonSerializable {

    /**
     *
     * @var string menu item key (id) 
     */
    protected $key;

    /**
     *
     * @var string menu item name
     */
    protected $name;

    /**
     *
     * @var string menu item disabled javascript function
     */
    protected $disabled;

    /**
     *
     * @var string menu item callback javascript function
     */
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
            $js .= ',' . JavascriptFormatter::prepareJavascriptText($disabledFunc);
        }
        if (isset($this->disabled) && !is_null($this->callback)) {
            $callbackFunc = "callback: function() { " .
                    $this->callback
                    . " }";
            $js .= ',' . JavascriptFormatter::prepareJavascriptText($callbackFunc);
        }
    }

}