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
class Config
{

    /**
     * Return an array which contains handsontable JS librairies and CSS web paths
     *
     * @return array contains handsontable JS librairies and CSS web paths
     */
    public static function getLibrairiesPath()
    {
        return [
            'handsontable' => [
                'js' => ['https://docs.handsontable.com/0.35.1/bower_components/handsontable/dist/handsontable.full.js'],
                'css' => ['https://docs.handsontable.com/0.35.1/bower_components/handsontable/dist/handsontable.full.min.css']
            ],
            'moment' => [
                'js' => ['https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.js'],
            ],
            'pikaday' => [
                'js' => ['https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.js'],
                'css' => ['https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.css']
            ],
            'jquery' => [ 'js' => ['https://code.jquery.com/jquery-3.2.1.min.js']]
        ];
    }
}
