<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace tokenizer;

/**
 * Extend dummy for store current string position
 * for logging purpose, source
 *
 * @author Mendel
 */
class MetadataTokenizer extends DummyTokenizer
{
    /**
     * @var string Current source (filename or other)
     */
    private $source = '';

    /**
     * @var int Current string number
     */
    private $currentStringNum = 0;

    /**
     * @var int Current column number
     */
    private $currentColNum = 0;

    /**
     * Tokenize string, add tokens to current result
     *
     * @param string $input
     * @param string $source source name (added to token, default - filename)
     */
    public function addString(string $input, string $source = 'inline')
    {
        $this->source = $source;
        parent::addString($input);
    }

    /**
     * Push current char from input to current buffer
     **/
    protected function push()
    {
        // If current empty - start of token
        if ($this->current->isEmpty()) {
            $this->currentStringNum = $this->input->stringNum;
            $this->currentColNum = $this->input->colNum;
        }
        parent::push();
    }
    
    /**
     * Create token object for current token
     *
     * @param string $type token type
     * @return \tokenizer\Token
     */
    protected function currentToken(string $type) : Token
    {
        $unit = parent::currentToken($type);
        $unit->source = $this->source;
        $unit->stringNum = $this->currentStringNum;
        $unit->colNum = $this->currentColNum;
        return $unit;
    }
}
