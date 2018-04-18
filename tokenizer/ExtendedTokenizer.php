<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace tokenizer;

/**
 * Extended tokenizer (with sugar functions for most useful case)
 *
 * @author Mendel
 */
class ExtendedTokenizer extends MetadataTokenizer implements ExtendedTokenizerInterface
{
    /**
     * Configurate tokenizer from JSON-file
     *
     * @param string $filename
     */
    public function configurateByFile(string $filename)
    {
        $data = file_get_contents($filename);
        $config = json_decode($data, true);
        $this->configurate($config);
    }
    
    /**
     * Tokenize file, clear storage and return all tokens
     *
     * @param string $filename
     * @param string $source source name (added to token, default - filename)
     * @return array
     */
    public function tokenizeFile(string $filename, string $source = null) : array
    {
        if (empty($source)) {
            $source = $filename;
        }
        $input = file_get_contents($filename);
        return $this->tokenizeString($input, $source);
    }
    
    /**
     * Tokenize string, clear storage and return all tokens
     *
     * @param string $input
     * @param string $source source name (added to token, default - filename)
     * @return array
     */
    public function tokenizeString(string $input, string $source = 'inline') : array
    {
        $this->reset();
        parent::addString($input, $source);
        $tokens  = $this->data();
        $this->reset();
        return $tokens;
    }

    /**
     * Tokenize file, add tokens to current result
     *
     * @param string $filename
     * @param string $source source name (added to token, default - filename)
     */
    public function addFile(string $filename, string $source = null)
    {
        if (empty($source)) {
            $source = $filename;
        }
        $input = file_get_contents($filename);
        parent::addString($input, $source);
    }
}
