<?php

//******************************************************************************
//                                       CustomCell.php
//
// Author(s): Arnaud Charleroy<arnaud.charleroy@inra.fr>
// SILEX version 1.0
// Copyright © - INRA - 2018
// Creation date: 14 feb. 2018
// Contact: arnaud.charleroy@inra.fr, anne.tireau@inra.fr, pascal.neveu@inra.fr
// Last modification date:  14 feb. 2018
// Subject: Class that represent a custom cell
//******************************************************************************

namespace openSILEX\handsontablePHP\classes;

use \openSILEX\handsontablePHP\tools\JSFunction;

/**
 * @link http://www.inra.fr/
 * @copyright Copyright © INRA - 2018
 * @license https://www.gnu.org/licenses/agpl-3.0.fr.html AGPL-3.0
 */
class CustomCellType implements \JsonSerializable {

    /**
     * 
     * @param string $name
     */
    function __construct(string $name) {
        $this->name = $name;
    }
    
    function getEditor(): type {
        return $this->editor;
    }

    function getRenderer() {
        return $this->renderer;
    }

    function getValidator() {
        return $this->validator;
    }

    function getClassName() {
        return $this->className;
    }

    function getAllowInvalid() {
        return $this->allowInvalid;
    }

    function getMyCustomCellState() {
        return $this->myCustomCellState;
    }

    function getName() {
        return $this->name;
    }

    function setEditor(type $editor) {
        $this->editor = $editor;
    }

    function setRenderer($renderer) {
        $this->renderer = $renderer;
    }

    function setValidator($validator) {
        $this->validator = $validator;
    }

    function setClassName($className) {
        $this->className = $className;
    }

    function setAllowInvalid($allowInvalid) {
        $this->allowInvalid = $allowInvalid;
    }

    function setMyCustomCellState($myCustomCellState) {
        $this->myCustomCellState = $myCustomCellState;
    }

    function setName($name) {
        $this->name = $name;
    }

    
    /**
     * Handsontable.editors.TextEditor.prototype.extend();
     * @var type 
     */
    protected $editor;

    /**
     * function customRenderer(hotInstance, td, row, column, prop, value, cellProperties) {
     *   // ...renderer logic => $renderer
     *    }
     * @var string 
     */
    protected $renderer;

    /**
     * function customValidator(query, callback) {
     * // ...validator logic callback(* Pass `true` or `false` *); =>  $validator
     * }
     * @var string 
     */
    protected $validator;

    /**
     *
     * @var string 
     */
    protected $className;

    /**
     * @var bool
     */
    protected $allowInvalid;
    // Or you can add custom properties which will be accessible in `cellProperties`
    /**
     *
     * @var string 
     */
    protected $myCustomCellState;

    /**
     *
     * @var string name of the cell type 
     */
    protected $name;

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * Inherited from \JsonSerializable::jsonSerialize() method
     * @example
     *  Handsontable.cellTypes.registerCellType('my.custom', {
     *      editor: MyEditor,
     *      renderer: customRenderer,
     *      validator: customValidator,
     *      // You can add additional options to the cell type based on Handsontable settings
     *      className: 'my-cell',
     *      allowInvalid: true,
     *      // Or you can add custom properties which will be accessible in `cellProperties`
     *      myCustomCellState: 'complete',
     * });
     *
     * @return mixed data which can be serialized by <b>json_encode</b>
     */
    public function jsonSerialize() {
        $str = "(function(Handsontable){ " . PHP_EOL
            . "Handsontable.cellTypes.registerCellType('{$this->name}', {" . PHP_EOL;

        foreach ($this as $attribute => $value) {
            if ($attribute !== 'name') {
                switch ($attribute) {
                    case 'renderer':
                        $tmpValueRenderer = JavascriptFormatter::prepareJavascriptText($value, true);
                        $jsFunction = new JSFunction("function (hotInstance, td, row, column, prop, value, cellProperties) { "
                                . "{$tmpValueRenderer} }");
                        $str .= " {$attribute} : {$jsFunction->jsonSerialize()} , " . PHP_EOL;
                        break;
                    case 'validator':
                        $tmpValueValidator = JavascriptFormatter::prepareJavascriptText($value, true);
                        $jsFunction = new JSFunction("function (query, callback) { "
                                . "{$tmpValueValidator} }");
                $str .= " {$attribute} : {$jsFunction->jsonSerialize()} , " . PHP_EOL;
                        break;
                    default:
                        $valueFormatted = $value;
                        if (is_bool($value)) {
                            $valueFormatted = json_encode($value, JSON_PRETTY_PRINT);
                        }
                        $str .= " {$attribute} : {$value}," . PHP_EOL;
                        break;
                }
            }
        }
        $str .= '  }); ' . PHP_EOL .
                '})(Handsontable);';
        return $str;
    }

}
