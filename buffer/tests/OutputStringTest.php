<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace buffer\tests;

/**
 * Test OutputString
 *
 * @author Mendel
 */
class OutputStringTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \buffer\OutputString
     */
    protected $buffer;

    /**
     * SetUp
     */
    public function setUp() : void
    {
        $this->buffer = new \buffer\OutputString();
    }

    /**
     * Destroy
     */
    public function tearDown() : void
    {
        $this->buffer = null;
    }
    
    /**
     * Test push data
     */
    public function testPushData()
    {
        $this->pushArray(['q', 'w', 'e', 'r', "\n", 't', 'y']);
        $this->assertEquals($this->buffer->data(), "qwer\nty");
    }

    /**
     * Test reset
     */
    public function testReset()
    {
        $this->pushArray(['q', 'w', 'e', 'r', 't', 'y']);
        $this->buffer->reset();
        $this->pushArray(['q', 'w', 'e', 'r', "\n", 't', 'y']);
        $this->assertEquals($this->buffer->data(), "qwer\nty");
    }
    
    /**
     * Internal function for add array to buffer
     * в тестируемый буффер
     * @param array $arr
     */
    protected function pushArray($arr)
    {
        foreach ($arr as $line) {
            $this->buffer->push($line);
        }
    }
}
