<?php

namespace openSILEX\handsontablePHP\adapter;

/**
 * Description of HandSoneTableZend
 *
 * @author charlero
 */
class HandsontableSimple extends \openSILEX\handsontablePHP\classes\Handsontable {

    /**
     * Load all required js librairies
     * @param array $librairiesPath [ handsontable => ['js => '...', 'css' => ['...']], 'jquery' => ['js => '...', 'css' => ['...']]]
     * @return string Script 
     */
    public function loadJSLibraries($jquery = false, $librairiesPath = []) {
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
     * @param array $librairiesPath [ handsontable => ['js => '...', 'css' => ['...']], 'jquery' => ['js => '...', 'css' => ['...']]]
     * @return string Script 
     */
    public function loadCSSLibraries($jquery = false,$librairiesPath = []) {
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

    public function render() {
        
    }

}
