<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace tests\buffer;

/**
 * Test CurrentString
 *
 * @author Mendel
 */
class CurrentStringTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \buffer\CurrentString
     */
    protected $buffer;

    /**
     * SetUp
     */
    public function setUp()
    {
        $this->buffer = new \buffer\CurrentString();
        $arr = ['q', 'w', 'e', 'r', 't', 'y', "\n", 'u', 'i', 'o', 'p'];
        foreach ($arr as $line) {
            $this->buffer->push($line);
        }
    }

    /**
     * Destroy
     */
    public function tearDown()
    {
        $this->buffer = null;
    }

    /**
     * Test startBy true
     */
    public function testStartByTrue()
    {
        $this->assertEquals($this->buffer->startBy('qwerty'), true);
    }
    
    /**
     * Test startBy false
     */
    public function testStartByFalse()
    {
        $this->assertEquals($this->buffer->startBy('none'), false);
    }
    
    /**
     * Test endBy true
     */
    public function testEndByTrue()
    {
        $this->assertEquals($this->buffer->endBy('iop'), true);
    }
    
    /**
     * Test endBy false
     */
    public function testEndByFalse()
    {
        $this->assertEquals($this->buffer->endBy('none'), false);
    }
    
    /**
     * Test endByArray true
     */
    public function testEndByArrayTrue()
    {
        $this->assertEquals($this->buffer->endByArray(['qwerty', 'iop']), true);
    }
    
    /**
     * Test endByArray false
     */
    public function testEndByArrayFalse()
    {
        $this->assertEquals($this->buffer->endByArray(['none','qwerty']), false);
    }
}
