<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace buffer\tests;

/**
 * Test SmartCurrentString
 *
 * @author Mendel
 */
class SmartCurrentStringTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \buffer\SmartCurrentString
     */
    protected $buffer;

    /**
     * SetUp
     */
    public function setUp()
    {
        $this->buffer = new \buffer\SmartCurrentString();
        $arr = ['q', 'w', 'e', 'r', 't', 'y', "\n", 'u', 'i', 'o', 'p'];
        foreach ($arr as $line) {
            $this->buffer->push($line);
        }
    }

    /**
     * Destroy unit
     */
    public function tearDown()
    {
        $this->buffer = null;
    }

    /**
     * Test currentCountStartBy for zero result
     */
    public function testCurrentCountStartByZero()
    {
        $tokens = ['qwer', 'tyui'];
        $result = $this->buffer->currentCountStartBy($tokens);
        $this->assertEquals($result, 0);
    }

    /**
     * Test currentCountStartBy for one result
     */
    public function testCurrentCountStartByOne()
    {
        $tokens = ["qwerty\nuiop1", "qwerty"];
        $result = $this->buffer->currentCountStartBy($tokens);
        $this->assertEquals($result, 1);
    }

    /**
     * Test currentCountStartBy for two result
     */
    public function testCurrentCountStartByTwo()
    {
        $tokens = ["qwerty\nuiop1", "qwerty\nuiop2", "qwerty\nas"];
        $result = $this->buffer->currentCountStartBy($tokens);
        $this->assertEquals($result, 2);
    }

    /**
     * Test futureCountStartBy for zero result
     */
    public function testFutureCountStartByZero()
    {
        $tokens = ['qwer', 'tyui'];
        $result = $this->buffer->futureCountStartBy('', $tokens);
        $this->assertEquals($result, 0);
    }

    /**
     * Test futureCountStartBy for one result
     */
    public function testFutureCountStartByOne()
    {
        $tokens = ["qwerty\nuiop10", "qwerty"];
        $result = $this->buffer->futureCountStartBy('1', $tokens);
        $this->assertEquals($result, 1);
    }

    /**
     * Test futureCountStartBy for zero result
     */
    public function testFutureCountStartByTwo()
    {
        $tokens = ["qwerty\nuiop10", "qwerty\nuiop11", "qwerty\nas"];
        $result = $this->buffer->futureCountStartBy('1', $tokens);
        $this->assertEquals($result, 2);
    }

    /**
     * Test escData
     */
    public function testEscData()
    {
        $result = $this->buffer->escData(['rt','u']);
        $this->assertEquals($result, 'iop');
    }

    /**
     * Test escEndBy true
     */
    public function testEscEndByTrue()
    {
        $escSubTokens = ['rt','u'];
        $result = $this->buffer->escEndBy('op', $escSubTokens);
        $this->assertEquals($result, true);
    }

    /**
     * Test escEndBy false
     */
    public function testEscEndByFalse()
    {
        $escSubTokens = ['rt','u'];
        $result = $this->buffer->escEndBy('none', $escSubTokens);
        $this->assertEquals($result, false);
    }
}
