<?php
/**
 * Example usage
 */
require_once 'bootstrap.php';
//
$ruleFilename = HOME.'/tests/tokenizer/quoted/rules.json';
$inputFilename = HOME.'/tests/tokenizer/quoted/in';
$sourceName = 'sample.quoted';
//
$tokenizer = new \tokenizer\Tokenizer();
$tokenizer->configurateByFile($ruleFilename);
$tokens = $tokenizer->tokenizeFile($inputFilename, $sourceName);
// Concatenate pretty
$out = '';
foreach ($tokens as $line) {
    $out = $out . $line->pretty() . "\n";
}
echo $out;
