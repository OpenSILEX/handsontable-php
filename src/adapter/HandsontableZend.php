<?php

//******************************************************************************
//                              HandSontableZend.php
//
// Author(s): Arnaud Charleroy
// SILEX version 1.0
// Copyright © - INRA - 2018
// Creation date: 26 janv. 2018
// Contact: arnaud.charleroy@inra.fr, anne.tireau@inra.fr, pascal.neveu@inra.fr
// Last modification date:  31 janv. 2018
// Subject: A class which specify Handsontable class for Zend Framework 1
//******************************************************************************

/**
 * @link http://www.inra.fr/
 * @copyright Copyright © INRA - 2018
 * @license https://www.gnu.org/licenses/agpl-3.0.fr.html AGPL-3.0
 */

namespace openSILEX\handsontablePHP\adapter;

/**
 * HandSontableZend is a class which extends Handsontable class for Zend Framework 1
 * @author Arnaud Charleroy <arnaud.charleroy@inra.fr>
 * @since 1.0
 */
class HandSontableZend extends \openSILEX\handsontablePHP\classes\Handsontable{
    
    /**
     * Used to render table and load handsontable js/css library
     * @var Zend_View zend view object 
     */
    protected $view;


    public function setView($view) {
        $this->view = $view;
    }

    
    public function loadJSLibraries() {
//        $this->view->loadViewLibrairies(array('handsontable' => array()));
       
    }

    public function render() {
//        $this->loadJSLibraries();
        $this->view->jQuery()->addOnLoad($this->generateJavascriptCode());
     
    }

    public function loadCSSLibraries() {
        
    }

}
