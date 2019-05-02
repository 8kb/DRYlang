<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace buffer\tests;

/**
 * Test OutputArray
 *
 * @author Mendel
 */
class OutputArrayTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \buffer\OutputArray
     */
    protected $buffer;

    /**
     * SetUp
     */
    public function setUp() : void
    {
        $this->buffer = new \buffer\OutputArray();
    }

    /**
     * Destroy
     */
    public function tearDown() : void
    {
        $this->buffer = null;
    }
    
    /**
     * Test push
     */
    public function testPushData()
    {
        $this->pushArray(['q', 'w', 'e', 'r', "\n", 't', 'y']);
        $this->assertEquals($this->buffer->data(), ['q', 'w', 'e', 'r', "\n", 't', 'y']);
    }

    /**
     * Test reset
     */
    public function testReset()
    {
        $this->pushArray(['q', 'w', 'e', 'r', 't', 'y']);
        $this->buffer->reset();
        $this->pushArray(['q', 'w', 'e', 'r', "\n", 't', 'y']);
        $this->assertEquals($this->buffer->data(), ['q', 'w', 'e', 'r', "\n", 't', 'y']);
    }
    
    /**
     * Internal function for add array
     * @param array $arr
     */
    protected function pushArray($arr)
    {
        foreach ($arr as $line) {
            $this->buffer->push($line);
        }
    }
}
