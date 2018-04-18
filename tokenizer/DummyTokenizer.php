<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace tokenizer;

/**
 * Абстрактный скелет токенайзера
 * содержит весь сервисный код
 * расширяется основной логикой разбора по токенам
 *
 * @author Mendel
 */
class DummyTokenizer implements BasicTokenizerInterface
{
    /**
     * @var \buffer\SmartInputString input buffer
     **/
    protected $input;

    /**
     * @var \buffer\SmartCurrentString current buffer
     **/
    protected $current;

    /**
     * @var \buffer\OutputArray output buffer
     **/
    private $output;

    /**
     * @var string Default token type
     */
    protected $defaultType = '';

    /**
     * Configurate tokenizer
     *
     * @param array $config
     */
    public function configurate(array $config)
    {
        $this->defaultType = $config['defaultType'];
        $this->current = new \buffer\SmartCurrentString();
        $this->output = new \buffer\OutputArray();
    }

    /**
     * Parse string and add result at current result
     *
     * @param string $input input text
     */
    public function addString(string $input)
    {
        $this->input = new \buffer\SmartInputString($input);
        while (!$this->input->isEmpty()) {
            $this->mainLoopStep();
        }
        $this->finishToken($this->defaultType);
    }
    
    /**
     * Body of main loop (for each char)
     * @see addString()
     */
    protected function mainLoopStep()
    {
        $this->push();
        $this->input->next();
    }
    
    
    /**
     * Push current char from input to current buffer
     **/
    protected function push()
    {
        $char = $this->input->current();
        $this->current->push($char);
    }

    /**
     * Finish current token - save new token in output if current not empty
     *
     * @param string $type token type
     */
    protected function finishToken(string $type)
    {
        if (!$this->current->isEmpty()) {
            $unit = $this->currentToken($type);
            $this->output->push($unit);
            $this->current->reset();
        }
    }
    
    /**
     * Create token object for current token
     *
     * @param string $type token type
     * @return \tokenizer\Token
     */
    protected function currentToken(string $type) : Token
    {
        $unit = new Token();
        $unit->value = $this->current->data();
        $unit->type = $type;
        return $unit;
    }

    /**
     * Return current result
     *
     * @return array
     */
    public function data() : array
    {
        $data = $this->output->data();
        return $data;
    }
    
    /**
     * Clear internal storage
     */
    public function reset()
    {
        $this->output->reset();
    }
}
