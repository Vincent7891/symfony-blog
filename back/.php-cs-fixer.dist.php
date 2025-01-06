<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'native_function_invocation' => [
            'include' => ['@internal'],
            'strict' => false,
        ],
        'php_unit_method_casing' => [
            'case' => 'camel_case',
        ],
        'single_quote' => [
            'strings_containing_single_quote_chars' => true,
        ],
        'cast_spaces' => [
            'space' => 'single',
        ],
        'binary_operator_spaces' => [
            'default' => 'single_space',
        ],
        'trailing_comma_in_multiline' => [
            'elements' => ['arguments', 'arrays', 'match', 'parameters'],
        ],
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
