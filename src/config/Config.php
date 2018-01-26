<?php

namespace openSILEX\handsontablePHP\config;

class Config {

    public static function getLibrairiesPath() {
        return [
            'handsontable' => [
                'js' => ['https://cdnjs.cloudflare.com/ajax/libs/handsontable/0.34.5/handsontable.min.js'],
                'css' => ['https://cdnjs.cloudflare.com/ajax/libs/handsontable/0.34.5/handsontable.min.css']
            ],
            'jquery' => [ 'js' => ['https://code.jquery.com/jquery-3.2.1.min.js']]
        ];
    }


}
