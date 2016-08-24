<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests/unit')
    ->in(__DIR__ . '/tests/functional')
    ->in(__DIR__ . '/tests/acceptance')
;

return Symfony\CS\Config\Config::create()
    ->finder($finder)
    ->setUsingCache(false)
    ->level(\Symfony\CS\FixerInterface::PSR2_LEVEL)
    ->fixers(
        [
            'psr0',
            'psr1',
            'psr2',
            'array_element_no_space_before_comma',
            'array_element_white_space_after_comma',
            'blankline_after_open_tag',
            'double_arrow_multiline_whitespaces',
            'duplicate_semicolon',
            'empty_return',
            'extra_empty_lines',
            'include',
            'join_function',
            'function_typehint_space',
            'multiline_array_trailing_comma',
            'namespace_no_leading_whitespace',
            'new_with_braces',
            'no_empty_lines_after_phpdocs',
            'object_operator',
            'operators_spaces',
            'phpdoc_indent',
            'phpdoc_inline_tag',
            'phpdoc_no_access',
            'phpdoc_no_empty_return',
            'phpdoc_no_package',
            'phpdoc_scalar',
            'phpdoc_separation',
            'phpdoc_trim',
            'phpdoc_type_to_var',
            'phpdoc_types',
            'print_to_echo',
            'remove_lines_between_uses',
            'return',
            'self_accessor',
            'short_bool_cast',
            'single_array_no_trailing_comma',
            'single_blank_line_before_namespace',
            'single_quote',
            'spaces_before_semicolon',
            'spaces_cast',
            'standardize_not_equal',
            'ternary_spaces',
            'trim_array_spaces',
            'unalign_double_arrow',
            'unalign_equals',
            'unneeded_control_parentheses',
            'unused_use',
            'whitespacy_lines',
            'concat_with_spaces',

            'ereg_to_preg',
            'ordered_use',
            'phpdoc_order',
            'short_array_syntax',
            'short_echo_tag',
            'no_useless_else',
            'silenced_deprecation_error',
        ]
    )
;
