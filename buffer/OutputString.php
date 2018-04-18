<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace buffer;

/**
 * Output buffer (string)
 **/
class OutputString implements OutputInterface
{
    /**
     * @var string Internal storage
     **/
    protected $data = '';

    /**
     * Add string to buffer
     *
     * @param string $data
     */
    public function push($data)
    {
        $this->data = $this->data . $data;
    }

    /**
     * Delete last N chars, where N equal to length of $end
     * @2DO: add check what buffer end by $end
     *
     * @param string $end
     */
    public function deleteEnd(string $end)
    {
        $dataLen = mb_strlen($this->data);
        $endLen = mb_strlen($end);
        $this->data = mb_substr($this->data, 0, $dataLen - $endLen);
    }
    
    /**
     * Get current string
     *
     * @return string
     */
    public function data() : string
    {
        return $this->data;
    }
    
    /**
     * Clear internal storage
     */
    public function reset()
    {
        $this->data = '';
    }

    /**
     * Check if buffer is empty
     *
     * @return boolean
     */
    public function isEmpty() : bool
    {
        return ($this->data == '');
    }
}
