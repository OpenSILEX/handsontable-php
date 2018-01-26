<?php

namespace openSILEX\handsontablePHP\tools;

//******************************************************************************
//                              JsonExpression.php
//
// Author(s): Arnaud Charleroy
// SILEX version 1.0
// Copyright © - INRA - 2018
// Creation date: 26 janv. 2018
// Contact: arnaud.charleroy@inra.fr, anne.tireau@inra.fr, pascal.neveu@inra.fr
// Last modification date:  26 janv. 2018
// Subject: A class used to format or transform data in JSON
//******************************************************************************

class JsonExpression {
    /* The javascript expression
     *
     * @var string
     */

    private $expression;

    /**
     * The JsonExpression constructor
     *
     * @param string $expression The javascript expression
     */
    public function __construct($expression) {
        $this->expression = iconv(
                mb_detect_encoding($expression), "UTF-8", $expression
        );
    }

    /**
     * Returns the javascript expression
     *
     * @return string The javascript expression
     */
    public function getExpression() {
        return $this->expression;
    }

    /**
     * This file is a modified part of the DataTable package
     * 
     * (c) Marc Roulias <marc@lampjunkie.com>
     * 
     * For the full copyright and license information, please view the LICENSE
     * file that was distributed with this source code.
     *  * Build a unique key for the given javascript function
     * and store they key => function in the local jsonFunctions
     * variable.
     * 
     * This key will get used later in replaceFunctions to replace
     * the key with the actual function to fix the final json string.
     * @param string $js represents js text
     * @return string
     */
    public static function buildJson($js) {
        // remove comments
        $jsWithoutComment = preg_replace('!/\*.*?\*/!s', '', $js);  // removes /* comments */
        $jsWithoutNewLine = preg_replace('!//.*?\n!', '', $jsWithoutComment); // removes //newline
        // remove all extra whitespace
        $jsWithoutExtraWhitespace = str_replace(array("\t", "\n", "\r\n"), '', trim($jsWithoutNewLine));

        $jsWithoutDoubleQuote = str_replace('"', '', $jsWithoutExtraWhitespace);

        return $jsWithoutDoubleQuote;
    }

    /**
     * Create a clean array from an mutliple or simple dimension array to convert it in a JSON array
     * @param array $array array which needs to be cleaned
     * @return array cleaned array
     */
    static function arrayRecursiveJsonFormat($array) {
        $newArray = [];
        foreach ($array as $key => $value) {
            if(is_array($value) ){
                $newValue = static::arrayRecursiveJsonFormat($value);
            }elseif (is_string($value)) {
                $newValue = '\'' . $value . '\'';
            }else{
                $newValue = $value;
            }
            $newArray[$key] = $newValue;
        }
        
        return $newArray;
    }

}
