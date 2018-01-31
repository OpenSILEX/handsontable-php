<?php

//******************************************************************************
//                              Config.php
//
// Author(s): Arnaud Charleroy
// SILEX version 1.0
// Copyright © - INRA - 2018
// Creation date: 26 janv. 2018
// Contact: arnaud.charleroy@inra.fr, anne.tireau@inra.fr, pascal.neveu@inra.fr
// Last modification date:  26 janv. 2018
// Subject: A class which store handsontable JS librairies and CSS default web paths
//******************************************************************************

/**
 * @link http://www.inra.fr/
 * @copyright Copyright © INRA - 2018
 * @license https://www.gnu.org/licenses/agpl-3.0.fr.html AGPL-3.0
 */

namespace openSILEX\handsontablePHP\config;

/**
 * Config class store web handsontable JS librairies paths
 * @author Arnaud Charleroy <arnaud.charleroy@inra.fr>
 * @since 1.0
 */
class Config {

    /**
     * Return an array which contains handsontable JS librairies and CSS web paths
     * 
     * @return array contains handsontable JS librairies and CSS web paths
     */
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
