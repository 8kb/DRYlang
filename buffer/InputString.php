<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace buffer;

/**
 * Input buffer (string)
 **/
class InputString implements InputInterface
{
    /**
     * @var string Internal storage
     **/
    protected $data = '';
    
    /**
     * @var int current position
     */
    protected $cursor = 0;

    /**
     * Constructor
     *
     * @param string $data input string for iterate
     */
    public function __construct(string $data)
    {
        $this->data = $data;
    }

    /**
     * Check if buffer is empty
     *
     * @return boolean
     */
    public function isEmpty() : bool
    {
        $len = mb_strlen($this->data);
        return $this->cursor >= $len;
    }
    
    /**
     * Get current value (char)
     *
     * @return string
     */
    public function current() : string
    {
        if ($this->isEmpty()) {
            throw new \Exception('Invalid current value');
        }
        return mb_substr($this->data, $this->cursor, 1);
    }
    
    /**
     * Move cursor to the next char
     */
    public function next()
    {
        $this->cursor++;
    }
}
