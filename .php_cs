<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests')
;

return Symfony\CS\Config\Config::create()
    ->finder($finder)
    ->setUsingCache(false)
    ->level(\Symfony\CS\FixerInterface::PSR2_LEVEL)
    ->fixers(
        [
            'blankline_after_open_tag',
            //'braces',
            'concat_with_spaces',
            '-concat_without_spaces',
            'double_arrow_multiline_whitespaces',
            'duplicate_semicolon',
            'empty_enclosing_lines',
            'encoding',
            'extra_empty_lines',
            'include',
            'function_declaration',
            'list_commas',
            'multiline_array_trailing_comma',
            'namespace_no_leading_whitespace',
            'new_with_braces',
            'object_operator',
            'operator_spaces',
            '-phpdoc_params',
            'phpdoc_no_access',
            'phpdoc_no_package',
            'phpdoc_order',
            'phpdoc_scalar',
            'phpdoc_separation',
            'phpdoc_to_comment',
            'phpdoc_trim',
            'phpdoc_type_to_var',
            'phpdoc_var_without_name',
            'psr0',
            'remove_leading_slash_use',
            '-ordered_use',
            'remove_lines_between_uses',
            'return',
            'self_accessor',
            'single_array_no_trailing_comma',
            'single_line_before_namespace',
            'single_quote',
            'short_array_syntax',
            'short_tag',
            'spaces_before_semicolon',
            'spaces_cast',
            'standardize_not_equal',
            'ternary_spaces',
            'trim_array_spaces',
            'unalign_double_arrow',
            'unalign_equals',
            'unary_operators_spaces',
            'unused_use',
            'whitespacy_lines',
        ]
    )
;

