<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace tokenizer;

/**
 * Interface for extended tokenizer (with sugar functions for most useful case)
 *
 * @author Mendel
 */
interface ExtendedTokenizerInterface extends BasicTokenizerInterface
{
    /**
     * Configurate tokenizer from JSON-file
     *
     * @param string $filename
     */
    public function configurateByFile(string $filename);
    
    /**
     * Tokenize file, clear storage and return all tokens
     *
     * @param string $filename
     * @param string $source source name (added to token, default - filename)
     * @return array
     */
    public function tokenizeFile(string $filename, string $source = null) : array;
    
    /**
     * Tokenize string, clear storage and return all tokens
     *
     * @param string $input
     * @param string $source source name (added to token, default - filename)
     * @return array
     */
    public function tokenizeString(string $input, string $source = 'inline') : array;
    
    /**
     * Tokenize file, add tokens to current result
     *
     * @param string $filename
     * @param string $source source name (added to token, default - filename)
     */
    public function addFile(string $filename, string $source = null);

    /**
     * Tokenize string, add tokens to current result
     *
     * @param string $input
     * @param string $source source name (added to token, default - filename)
     */
    public function addString(string $input, string $source = 'inline');
}
