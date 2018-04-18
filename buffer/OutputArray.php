<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace buffer;

/**
 * Output buffer (array)
 **/
class OutputArray implements \contract\OutputInterface
{
    /**
     * @var array internal storage
     */
    protected $data = [];

    /**
     * Add data to storage
     *
     * @param mixed $data
     */
    public function push($data)
    {
        $this->data[] = $data;
    }

    /**
     * Get all data from storage
     *
     * @return array
     */
    public function data() : array
    {
        return $this->data;
    }

    /**
     * Clear storage
     **/
    public function reset()
    {
        $this->data = [];
    }

    /**
     * Check if buffer is empty
     *
     * @return boolean
     */
    public function isEmpty() : bool
    {
        return ($this->data == []);
    }
}
