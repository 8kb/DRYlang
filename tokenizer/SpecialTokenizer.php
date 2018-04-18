<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace tokenizer;

/**
 * Tokenizer with special token (special token is token from special chars)
 *
 * @author Mendel
 */
class SpecialTokenizer extends ExtendedTokenizer
{
    /**
     * @var array List of all allowed tokens composed from special chars
     */
    private $specialTokens = [];

    /**
     * @var array Special chars list
     */
    private $specialSymbols = [];

    /**
     * Configurate tokenizer
     *
     * @param array $config
     */
    public function configurate(array $config)
    {
        $this->specialTokens  = $config['specialTokens'];
        $this->specialSymbols = $this->tokens2chars($this->specialTokens);
        parent::configurate($config);
    }

    /**
     * Get list of chars contained at tokens
     *
     * @param array $tokens special tokens
     * @return array
     */
    private function tokens2chars(array $tokens) : array
    {
        $unique = [];
        foreach ($tokens as $line) {
            $input = new \buffer\InputString($line);
            while (!$input->isEmpty()) {
                $char = $input->current();
                $input->next();
                if (!in_array($char, $unique)) {
                    $unique[] = $char;
                }
            }
        }
        return $unique;
    }

    /**
     * Body of main loop (for each char)
     * extended for special token
     * @see addString()
     */
    protected function mainLoopStep()
    {
        if ($this->isCurrentCharSpecial()) {
            $this->finishToken($this->defaultType);
            do {
                $this->specialSymbol();
            } while (!$this->input->isEmpty() and $this->isCurrentCharSpecial());
            $this->finishSpecialToken();
        } else {
            parent::mainLoopStep();
        }
    }
    
    /**
     * Check if current char is special
     *
     * @return boolean
     */
    private function isCurrentCharSpecial() : bool
    {
        return in_array($this->input->current(), $this->specialSymbols);
    }
    
    /**
     * Processing special symbol
     * @see mainLoopStep()
     *
     * @throws \WrongTokenException
     */
    protected function specialSymbol()
    {
        // Throw exception if not exist special token started from current string
        if ($this->current->currentCountStartBy($this->specialTokens) == 0) {
            throw new WrongTokenException($this->currentToken('badToken'));
        }
        // If after add current char - not exist token started from current,
        // it mean current string is token, and finish him :)
        if ($this->current->futureCountStartBy($this->input->current(), $this->specialTokens) == 0) {
            $this->finishSpecialToken();
        }
        // Push current char to current buffer
        $this->push();
        $this->input->next();
    }

    /**
     * Finish special token
     *
     * @throws \WrongTokenException
     */
    protected function finishSpecialToken()
    {
        // Throw exception if not exist special token equal to current
        if (!$this->current->isEmpty() and !in_array($this->current->data(), $this->specialTokens)) {
            throw new WrongTokenException($this->currentToken('badToken'));
        }
        $this->finishToken($this->defaultType);
    }
}
