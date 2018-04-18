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
        $ruleFilename = HOME.'/samples/minimal/rules.json';
        $inputFilename = HOME.'/samples/minimal/in';
        $outFilename = HOME.'/samples/minimal/out';
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
        $ruleFilename = HOME.'/samples/quoted/rules.json';
        $inputFilename = HOME.'/samples/quoted/in';
        $outFilename = HOME.'/samples/quoted/out';
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
        $ruleFilename = HOME.'/samples/php/rules.json';
        $inputFilename = HOME.'/samples/php/in';
        $outFilename = HOME.'/samples/php/out';
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
