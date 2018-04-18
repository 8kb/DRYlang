<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace buffer;

/**
 * Smart buffer - some smart function for current string
 **/
class SmartCurrentString extends CurrentString
{
    /**
     * Get count of token (from $tokens array) started from current buffer value
     *
     * @param array $tokens tokens array
     * @return int
     */
    public function currentCountStartBy(array $tokens) : int
    {
        return $this->countStartBy($this->data, $tokens);
    }
    
    /**
     * Get count of token (from $tokens array) started from current buffer value
     * and $nextChar i.e. started from $token+$nextChar
     *
     * @param string $nextChar
     * @param array $tokens
     * @return int
     */
    public function futureCountStartBy(string $nextChar, array $tokens) : int
    {
        $future = $this->data . $nextChar;
        return $this->countStartBy($future, $tokens);
    }
    
    /**
     * Get count of $tokens started by $needle
     *
     * @param string $needle
     * @param array $tokens
     * @return int
     */
    private function countStartBy(string $needle, array $tokens) : int
    {
        $count = 0;
        foreach ($tokens as $token) {
            $len = mb_strlen($needle);
            $subToken = mb_substr($token, 0, $len);
            if ($needle == $subToken) {
                $count++;
            }
        }
        return $count;
    }

    /**
     * Проверяет заканчивается ли содержимое буфера
     * искомой строкой отбросив ескейп-последовательности
     * Check if buffer end by $needle seeng to escape tokens
     *
     * @param string $needle
     * @param array $escSubTokens escape tokens
     * @return boolean
     */
    public function escEndBy(string $needle, array $escSubTokens = []) : bool
    {
        $data = $this->escData($escSubTokens);
        return $this->subEndBy($data, $needle);
    }

    /**
     * Get end of string after last escape string (from array of escTokens)
     * (public for test case)
     *
     * @param array $escSubTokens
     * @return string
     */
    public function escData(array $escSubTokens = []) : string
    {
        $input = new InputString($this->data);
        $current = new CurrentString();
        while (!$input->isEmpty()) {
            $current->push($input->current());
            $input->next();
            if ($current->endByArray($escSubTokens)) {
                $current->reset();
            }
        }
        return $current->data();
    }
}
