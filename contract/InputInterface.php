<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace contract;

/**
 * Input buffer interface
 *
 * @author Mendel
 */
interface InputInterface
{
    /**
     * Check if buffer is empty
     *
     * @return boolean
     */
    public function isEmpty() : bool;
    
    /**
     * Get current value
     *
     * @return mixed
     */
    public function current();

    /**
     * Move cursor to next value
     */
    public function next();
}
