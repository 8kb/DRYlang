<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace tokenizer;

/**
 * Excepion for wrong token
 *
 * @author Mendel
 */
class WrongTokenException extends \Exception
{
    /**
     * @var Token Wrong token
     */
    private $token;
    
    /**
     * Save token and set message
     * @param \tokenizer\Token $token
     */
    public function __construct(Token $token)
    {
        $this->token = $token;
        parent::__construct('Wrong token at '.$token->pretty());
    }
    
    /**
     * Return wrong token
     * @return \tokenizer\Token
     */
    public function getToken() : Token
    {
        return $this->token;
    }
}
