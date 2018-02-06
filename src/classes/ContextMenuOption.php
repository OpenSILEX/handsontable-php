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
class ContextMenuOption implements \JsonSerializable
{
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

    public function __construct($key, $name)
    {
        $this->key = $key;
        $this->name = $name;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDisabled()
    {
        return $this->disabled;
    }

    public function getCallback()
    {
        return $this->callback;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDisabled(\Closure $disabled)
    {
        $this->disabled = $disabled;
    }

    public function setCallback(\Closure $callback)
    {
        $this->callback = $callback;
    }

    
    /**
    * Specify data which should be serialized to JSON
    * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
    * Inherited from \JsonSerializable::jsonSerialize() method
    * @example  {
    *      name: "Copy",
    *      callback: function(key, opt){
    *          alert("Clicked on " + key);
    *      }
    *  }
    * }
    * @return mixed data which can be serialized by <b>json_encode</b>
    */
    public function jsonSerialize()
    {
        $js = "{
          key: '{$this->key}',"
                . "name: '{$this->name}'";
        // if a disabled function is set
        if (isset($this->disabled) && !is_null($this->disabled)) {
            $disabledFunc = "disabled: function() { " .
                    $this->disabled
                    . " }";
            $js .= ',' . JavascriptFormatter::prepareJavascriptText($disabledFunc);
        }
        // if a callback function is set
        if (isset($this->callback) && !is_null($this->callback)) {
            $callbackFunc = "callback: function() { " .
                    $this->callback
                    . " }";
            $js .= ',' . JavascriptFormatter::prepareJavascriptText($callbackFunc);
        }
    }
}
