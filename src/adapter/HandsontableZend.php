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
class HandSontableZend extends \openSILEX\handsontablePHP\classes\Handsontable {

    /**
     * Used to render table and load handsontable js/css library
     * @var Zend_View zend view object
     */
    protected $view;

    public function setView($view) {
        $this->view = $view;
    }

    /**
     * Load all required jss librairies with Zend Helper
     * Inherited from \openSILEX\handsontablePHP\classes\Handsontable::loadJSLibraries() method
     * @param boolean $jquery if jquery need to be loaded
     * @param array $librairiesPath array which contains required Javascript librairy 
     *              $librairiesPath = [
     *                      'handsontable' => [
     *                          'js => '...',
     *                          'css' => '...'],
     *                       'jquery' => [
     *                          'js => '...',
     *                          'css' => ['...']
     *                      ]
     *
     */
    public function loadJSLibraries($jquery = false, $librairiesPath = []) {
        if (empty($librairiesPath)) {
            $librairiesPath = \openSILEX\handsontablePHP\config\Config::getLibrairiesPath();
        }

        if (isset($librairiesPath['handsontable'])) {
            if (isset($librairiesPath['handsontable']['js'])) {
                foreach ($librairiesPath['handsontable']['js'] as $jsScript) {
                    $this->view->HeadScript()->appendFile($jsScript);
                }
            }
        }
        if ($jquery) {
            if (isset($librairiesPath['jquery'])) {
                if (isset($librairiesPath['jquery']['js'])) {
                    foreach ($librairiesPath['jquery']['js'] as $jsScript) {
                        $this->view->jQuery()->setLocalPath($jsScript);
                    }
                }
            }
        }
    }

    /**
     * Generate handsontable JS code with Zend JQuery Helper
     * Inherited from \openSILEX\handsontablePHP\classes\Handsontable::render() method
     * @see \openSILEX\handsontablePHP\classes\Handsontable
     */
    public function render() {
        $this->view->jQuery()->addOnLoad($this->generateJavascriptCode());
    }

    /**
     * Load all required css librairies with Zend Helper
     * Inherited from \openSILEX\handsontablePHP\classes\Handsontable::loadCSSLibraries() method
     * @param boolean $jquery if jquery need to be loaded
     * @param array $librairiesPath array which contains required Javascript librairy 
     *              $librairiesPath = [
     *                      'handsontable' => [
     *                          'js => '...',
     *                          'css' => '...'],
     *                       'jquery' => [
     *                          'js => '...',
     *                          'css' => ['...']
     *                      ]
     *
     */
    public function loadCSSLibraries($jquery = false, $librairiesPath = []) {
        if (empty($librairiesPath)) {
            $librairiesPath = \openSILEX\handsontablePHP\config\Config::getLibrairiesPath();
        }
        if (isset($librairiesPath['handsontable'])) {
            if (isset($librairiesPath['handsontable']['css'])) {
                foreach ($librairiesPath['handsontable']['css'] as $cssScript) {
                    $this->view->headLink()->appendStylesheet($cssScript);
                }
            }
        }
        if ($jquery) {
            if (isset($librairiesPath['jquery'])) {
                if (isset($librairiesPath['jquery']['css'])) {
                    foreach ($librairiesPath['jquery']['css'] as $cssScript) {
                        $this->view->jQuery()->addStylesheet($cssScript);
                    }
                }
            }
        }
    }

}
