<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace tests\buffer;

/**
 * Test InputArray
 *
 * @author Mendel
 */
class InputArrayTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test all functionality
     */
    public function testAll()
    {
        $input = new \buffer\InputArray(['q', 'w', 'e', 'r', 't', 'y']);
        $out = [];
        while (!$input->isEmpty()) {
            $out[] = $input->current();
            $input->next();
        }
        $this->assertEquals($out, ['q', 'w', 'e', 'r', 't', 'y']);
    }
}
