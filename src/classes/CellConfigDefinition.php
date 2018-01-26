<?php


namespace inra\handsontable\classes;

/**
 * Represent a cell configuration unit
 * @see https://docs.handsontable.com/0.34.5/tutorial-setting-options.html
 *
 * @author blue
 */
class CellConfigDefinition implements \JsonSerializable{
    protected $row;
    protected $col;
    protected $readOnly = false;
    
    function __construct($row, $col, $readOnly) {
        $this->row = $row;
        $this->col = $col;
        $this->readOnly = $readOnly;
    }
    
    public function isValid() {
        return (!is_null($this->row) && !is_null($this->col));
    }

    public function jsonSerialize() {
        return ['row' => $this->row, 'col' => $this->col,'readOnly' => $this->readOnly];
    }

}
