<?php

namespace openSILEX\handsontablePHP\Tests\JavascriptFormatterTest;

use PHPUnit\Framework\TestCase;
use openSILEX\handsontablePHP\tools\JavascriptFormatter;

/**
 * Description of testJavascriptFormatter
 *
 * @author Arnaud Charleroy <arnaud.charleroy@inra.fr>
 */
class JavascriptFormatterTest extends TestCase{
    
    public function testpreparePHPArrayToJSArray()
    {
        $data = [
            "yellow", 
            'red', 
            0, 
            'green', 
            'blue', 
            'gray', 
            'black', 
            'white'
        ];
        
        $this->assertSame($data, JavascriptFormatter::preparePHPArrayToJSArray($data));
        
       
    }

}
