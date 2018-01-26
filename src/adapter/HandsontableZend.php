<?php
namespace inra\handsontable\adapter;
//require_once 'views/helpers/loadViewLibrairies.php'; // Datatable
/**
 * Description of HandSoneTableZend
 *
 * @author charlero
 */
class HandSontableZend extends \inra\handsontable\classes\Handsontable{
    protected $view;



    public function setView($view) {
        $this->view = $view;
    }

    

    public function loadJSLibraries() {
        $this->view->loadViewLibrairies(array('handsontable' => array()));
       
    }

    public function render() {
        $this->loadJSLibraries();
        $this->view->jQuery()->addOnLoad($this->renderJavascriptCode());
     
    }

    public function loadCSSLibraries() {
        
    }

}