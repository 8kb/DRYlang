<?php
/**
 * Example usage
 */
require_once 'bootstrap.php';
//
$ruleFilename = HOME.'/samples/php/rules.json';
$inputFilename = HOME.'/samples/php/in';
$sourceName = 'sample.php';
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
