<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace tests\buffer;

/**
 * Test InputString
 *
 * @author Mendel
 */
class InputStringTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test all functionality
     */
    public function testAll()
    {
        $input = new \buffer\InputString("qwe\nrty");
        $out = [];
        while (!$input->isEmpty()) {
            $out[] = $input->current();
            $input->next();
        }
        $this->assertEquals($out, ['q', 'w', 'e', "\n", 'r', 't', 'y']);
    }
}
