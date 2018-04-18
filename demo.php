<?php
/**
 * Example usage
 */
require_once 'bootstrap.php';
//
$ruleFilename = HOME.'/tokenizer/tests/quoted/rules.json';
$inputFilename = HOME.'/tokenizer/tests/quoted/in';
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
