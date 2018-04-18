<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace tokenizer;

/**
 * Token - contains token body, token type, source info etc
 *
 * @author Mendel
 */
class Token
{
    /**
     * @var string Token type
     */
    public $type = 'unknown';

    /**
     * @var string Token value
     */
    public $value = '';

    /**
     * @var string Token source (default - filename)
     */
    public $source = '';

    /**
     * @var int String number
     */
    public $stringNum = 0;

    /**
     * @var int Column number
     */
    public $colNum = 0;

    /**
     * Pretty view (for debug purpose)
     *
     * @return string
     */
    public function pretty() : string
    {
        $value = '"' . addcslashes($this->value, "\0..\37\\") . '"';
        $str = $this->source . " (" . $this->stringNum . ":" . $this->colNum . ") ";
        $str = $str . $this->type . ': ' . $value;
        return $str;
    }
}
