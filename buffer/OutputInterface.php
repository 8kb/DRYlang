<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace buffer;

/**
 * Output buffer interface
 *
 * @author Mendel
 */
interface OutputInterface
{
    /**
     * Add data to storage
     *
     * @param mixed $data
     */
    public function push($data);

    /**
     * Get all data
     *
     * @return mixed
     */
    public function data();

    /**
     * Clear storage
     **/
    public function reset();

    /**
     * Check if buffer is empty
     *
     * @return boolean
     */
    public function isEmpty() : bool;
}
