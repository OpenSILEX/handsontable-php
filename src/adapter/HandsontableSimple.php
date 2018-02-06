<?php

//******************************************************************************
//                              HandsontableSimple.php
//
// Author(s): Arnaud Charleroy
// SILEX version 1.0
// Copyright © - INRA - 2018
// Creation date: 26 janv. 2018
// Contact: arnaud.charleroy@inra.fr, anne.tireau@inra.fr, pascal.neveu@inra.fr
// Last modification date:  31 janv. 2018
// Subject: A class which specify Handsontable class for native PHP usage
//******************************************************************************

/**
 * @link http://www.inra.fr/
 * @copyright Copyright © INRA - 2018
 * @license https://www.gnu.org/licenses/agpl-3.0.fr.html AGPL-3.0
 */

namespace openSILEX\handsontablePHP\adapter;

/**
 * HandsontableSimple is a class which extends Handsontable class for native PHP usage
 * @author Arnaud Charleroy <arnaud.charleroy@inra.fr>
 * @since 1.0
 */
class HandsontableSimple extends \openSILEX\handsontablePHP\classes\Handsontable
{

    /**
     * Load all required js librairies
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
     * @return string contains html script tag which will be put in head tags
     */
    public function loadJSLibraries($jquery = false, $librairiesPath = [])
    {
        if (empty($librairiesPath)) {
            $librairiesPath = \openSILEX\handsontablePHP\config\Config::getLibrairiesPath();
        }

        $js = '';
        if (isset($librairiesPath['handsontable'])) {
            if (isset($librairiesPath['handsontable']['js'])) {
                foreach ($librairiesPath['handsontable']['js'] as $jsScript) {
                    $js .= '<script src="' . $jsScript . '"></script>' . PHP_EOL;
                }
            }
        }
        if ($jquery) {
            if (isset($librairiesPath['jquery'])) {
                if (isset($librairiesPath['jquery']['js'])) {
                    foreach ($librairiesPath['jquery']['js'] as $jsScript) {
                        $js .= '<script src="' . $jsScript . '"></script>' . PHP_EOL;
                    }
                }
            }
        }
        return $js;
    }

    /**
     * Load all required css librairies
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
     * @return string contains html link tag which will be put in head tags
     */
    public function loadCSSLibraries($jquery = false, $librairiesPath = [])
    {
        if (empty($librairiesPath)) {
            $librairiesPath = \openSILEX\handsontablePHP\config\Config::getLibrairiesPath();
        }
        $css = '';
        if (isset($librairiesPath['handsontable'])) {
            if (isset($librairiesPath['handsontable']['css'])) {
                foreach ($librairiesPath['handsontable']['css'] as $cssScript) {
                    $css .= '<link type="text/css" rel="stylesheet" href="' . $cssScript . '">' . PHP_EOL;
                }
            }
        }
        if ($jquery) {
            if (isset($librairiesPath['jquery'])) {
                if (isset($librairiesPath['jquery']['css'])) {
                    foreach ($librairiesPath['jquery']['css'] as $cssScript) {
                        $css .= '<link type="text/css" rel="stylesheet" href="' . $cssScript . '">' . PHP_EOL;
                    }
                }
            }
        }

        return $css;
    }
    /**
     * Generate handsontable JS code
     * Inherited from \openSILEX\handsontablePHP\classes\Handsontable::render() method
     * @see \openSILEX\handsontablePHP\classes\Handsontable
     */
    public function render()
    {
        return $this->generateTableJSCode();
    }
}
