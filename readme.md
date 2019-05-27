The principle of the tokenizer
------------------------------
The Tokenizer receives text from the input, and outputs an array of tokens.
Tokens contain the actual token (string), metainformation about which line and which
column the token is taken from and the type of the token.
Actually the work of the tokenizer is the separation of one token from the surrounding ones and nothing more.
Metainformation (type, position in the source text, etc.) is added purely for convenience
since it already exists in the tokenizer and can be used further.
Metainformation for the main job does not matter - the type of the token and so on
can be determined from its contents, line and column numbers are only needed
for error messages and other debugging.
The logic of the tokenizer operation is not universal, but the limitations are not very significant. (see below)

Tokens are of three types:
-------------------------
1) Literals. Consist of "ordinary characters."
   Separated by "special tokens".
   A regular symbol is any character that is not a "delimiter" or "special character".
   The resolution of all characters except special ones is made to
   It was easier to add tokens in national languages, etc.
   Literals are utility words, variable names, numbers, constants, and so on.
   Validating literals is not a tokenizer problem.
   If the character is considered ordinary, then it can enter the literal anywhere.
   If there are any specific requirements (for example, the requirement that literals
   can not begin with a number) then such checks are already done
   at the level of abstract syntax and not a tokenizer.
2) "Special tokens". Special tokens consist of special characters (configurable).
   The list of special tokens is fixed (configurable).
   A special token consists only of special characters.
   There can not be special tokens containing ordinary characters (as well as vice versa).
   Special tokens can be separated by other special tokens (i.e. space EOL etc is special tokens).
   Since the list of specials is hard set, this usually does not cause a problem.
3) "Quoted tokens". There are tokens that do not obey the rules described above
   and which can not be avoided. For example, a typical example is a string quoted.
   In it already go not tokens but just text, and the text can be anything,
   including the text of our program, etc.
   Also to these tokens are comments of a different kind.
   Quoted tokens have a symbol (or symbols) of the beginning, end symbols and "escapes"
   which can not enter the end of the token.
   The start characters and end symbols MUST consist of special characters.
   Escape sequences are needed so that you can escape the characters of the completion of our token
   (in the simplest case - a quote), so that you can use these symbols in the text,
   well, at the same time you need to escape the escape character itself.
   The quoted token has the type specified in the settings, as well as the value equal to the text,
   which is contained between the opening and closing symbols.

Usage example:
```php
    $tokenizer = new \tokenizer\Tokenizer();
    $tokenizer->configurateByFile($ruleFilename);
    //
    $tokens = $tokenizer->tokenizeFile($inputFilename, $sourceName);
```
Configuration example:
```json
{
    "defaultType":"token",
    "specialTokens": [
        "separator": [
            " ", "\n", "\r", "\t"
        ],
        "bracket": [
            "{", "}", "(", ")", "[", "]"
        ],
        "other": [
            "<?",
            "=", "==", "!=", ">=", "<=", ">", "<",
            "=>", "::", "!", ";", ",", ".", "->",
            "+", "-", "*", "/",
            "$", "\\", "&"
        ]
    ],
    "quotedRules": [
        {"type":"singlQuotedString","startBy":"'", "endBy":"'", "escSubTokens":["\\\"", "\\\\"]},
        {"type":"dobleQuotedString", "startBy":"\"", "endBy":"\"", "escSubTokens":["\\\"", "\\\\"]},
        {"type":"remarkString","startBy":"//", "endBy":"\n", "escSubTokens":[]},
        {"type":"remarkBlock","startBy":"/*", "endBy":"*/", "escSubTokens":[]}
    ]
}
```

2DO:
-----
Write tests for error handling
Write tests for SmartInput
Write tests for separate tokenizer functions
Write tests for all kinds of tokenizer (including truncated ones)

Make a text recovery class from tokens
Correct the exception if there is no closing character for quoted ones and check other cycles