<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace buffer;

/**
 * Input buffer (array)
 **/
class InputArray implements InputInterface
{
    /**
     * @var array internal storage
     **/
    protected $data = [];
    
    /**
     * @var int current position
     */
    protected $cursor = 0;

    /**
     * Constructor
     *
     * @param array $data data for iterate
     */
    public function __construct(array $data)
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
        $count = count($this->data);
        return $this->cursor >= $count;
    }
    
    /**
     * Get current value
     *
     * @return mixed
     */
    public function current()
    {
        if ($this->isEmpty()) {
            throw new \Exception('Invalid current value');
        }
        return $this->data[$this->cursor];
    }
    
    /**
     * Move cursor to next value
     */
    public function next()
    {
        $this->cursor++;
    }
}
