<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace buffer;

/**
  * Current string burffer - output buffer extended with special function
  * (check values, etc.)
  **/
class CurrentString extends OutputString
{
    /**
     * Check if current string start by needle
     *
     * @param string $needle
     * @return boolean
     */
    public function startBy(string $needle) : bool
    {
        $data = $this->data;
        $len = strlen($needle);
        $sub = substr($data, 0, $len);
        return ($needle === $sub);
    }

    /**
     * Check if current string end by needle
     *
     * @param string $needle
     * @return boolean
     */
    public function endBy(string $needle) : bool
    {
        $data = $this->data;
        return $this->subEndBy($data, $needle);
    }

    /**
     * Check if current string end by value contained in array
     *
     * @param array $arr array of needles
     * @return boolean
     */
    public function endByArray(array $arr) : bool
    {
        $data = $this->data;
        foreach ($arr as $needle) {
            if ($this->subEndBy($data, $needle)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if $data end by $needle
     *
     * @param string $data
     * @param string $needle
     * @return boolean
     */
    protected function subEndBy(string $data, string $needle) : bool
    {
        $len = strlen($needle);
        $sub = substr($data, -$len);
        return ($needle === $sub);
    }
}
