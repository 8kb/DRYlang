<?php
/* 
 * @copyright (c) 2017 Mendel <mendel@zzzlab.com>
 * @license see license.txt
 */
namespace tokenizer\tests;

/**
 * Test Tokenizer
 *
 * @author Mendel
 */
class TokenizerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test basic functionality
     */
    public function testMinimal()
    {
        $ruleFilename = HOME.'/tokenizer/tests/minimal/rules.json';
        $inputFilename = HOME.'/tokenizer/tests/minimal/in';
        $outFilename = HOME.'/tokenizer/tests/minimal/out';
        $sourceName = 'sample.minimal';
        //
        $result = $this->tokenize($ruleFilename, $inputFilename, $sourceName);
        $goodResult = file_get_contents($outFilename);
        $this->assertEquals($goodResult, $result);
    }

    /**
     * Test "quoted" tokens
     */
    public function testQuoted()
    {
        $ruleFilename = HOME.'/tokenizer/tests/quoted/rules.json';
        $inputFilename = HOME.'/tokenizer/tests/quoted/in';
        $outFilename = HOME.'/tokenizer/tests/quoted/out';
        $sourceName = 'sample.quoted';
        //
        $result = $this->tokenize($ruleFilename, $inputFilename, $sourceName);
        $goodResult = file_get_contents($outFilename);
        $this->assertEquals($goodResult, $result);
    }

    /**
     * Php-sample test
     */
    public function testPhp()
    {
        $ruleFilename = HOME.'/tokenizer/tests/php/rules.json';
        $inputFilename = HOME.'/tokenizer/tests/php/in';
        $outFilename = HOME.'/tokenizer/tests/php/out';
        $sourceName = 'sample.php';
        //
        $result = $this->tokenize($ruleFilename, $inputFilename, $sourceName);
        $goodResult = file_get_contents($outFilename);
        $this->assertEquals($goodResult, $result);
    }
    
    /**
     * Sugar function for tokenize and concatenate pretty result
     *
     * @param string $ruleFilename rules filename
     * @param string $inputFilename input filename
     * @param string $sourceName source name
     * @return string
     */
    public function tokenize(string $ruleFilename, string $inputFilename, string $sourceName) : string
    {
        $tokenizer = new \tokenizer\Tokenizer();
        $tokenizer->configurateByFile($ruleFilename);
        //
        $tokens = $tokenizer->tokenizeFile($inputFilename, $sourceName);
        //Concatenate all pretty result
        $out = '';
        foreach ($tokens as $line) {
            $out = $out . $line->pretty() . "\n";
        }
        return $out;
    }
}
