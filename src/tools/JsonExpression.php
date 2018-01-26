<?php

namespace openSILEX\handsontablePHP\tools;

/**
 * Description of JsonExpression
 *
 * @author blue
 */
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
     * This file is part of the DataTable package
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
     * 
     * @return string
     */
    public static function buildJson($js) {
        // remove comments
        $js = preg_replace('!/\*.*?\*/!s', '', $js);  // removes /* comments */
        $js = preg_replace('!//.*?\n!', '', $js); // removes //comments
        // remove all extra whitespace
        $js = str_replace(array("\t", "\n", "\r\n"), '', trim($js));

        $js = str_replace('"', '', $js);
//        // build a temporary key
//        $jsonKey = md5($js);
//
//        // store key => function mapping
//        $this->jsonFunctions[$jsonKey] = $js;

        return $js;
    }

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
