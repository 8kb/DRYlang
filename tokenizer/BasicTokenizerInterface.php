<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace tokenizer;

/**
 * Basic tokenizer interface
 *
 * @author Mendel
 */
interface BasicTokenizerInterface
{
    /**
     * Configurate tokenizer
     *
     * @param array $config
     */
    public function configurate(array $config);
    
    /**
     * Parse string and add result at current result
     *
     * @param string $input input text
     */
    public function addString(string $input);
    
    /**
     * Return current result
     *
     * @return array
     */
    public function data() : array;
    
    /**
     * Clear internal storage
     */
    public function reset();
}
