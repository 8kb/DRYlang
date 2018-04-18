<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace buffer;

/**
 * Smart input buffer- some smart function for input string
 **/
class SmartInputString extends InputString
{
    /**
     * @var int Current string number
     */
    public $stringNum = 1;

    /**
     * @var int Current column number
     */
    public $colNum = 1;
    
    /**
     * Move cursor to next value and update counters
     */
    public function next()
    {
        if ($this->current() == "\n") {
            $this->stringNum++;
            $this->colNum = 0;
        }
        $this->colNum++;
        parent::next();
    }
}
