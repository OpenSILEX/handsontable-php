<?php

namespace openSILEX\handsontablePHP\config;

//******************************************************************************
//                              Config.php
//
// Author(s): Arnaud Charleroy
// SILEX version 1.0
// Copyright © - INRA - 2018
// Creation date: 26 janv. 2018
// Contact: arnaud.charleroy@inra.fr, anne.tireau@inra.fr, pascal.neveu@inra.fr
// Last modification date:  26 janv. 2018
// Subject: A class to retreive handsontable JS needed librairies
//******************************************************************************

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
