<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__);
//    ->in([
//        __DIR__ . '...',
//    ])
//    ->exclude([
//        '...'
//    ]);

return (new PhpCsFixer\Config())
//    ->setCacheFile(__DIR__ . '/var/phpcs/.php-cs-fixer.cache')
    ->setRules([
        '@PSR12' => true,
        'strict_param' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setFinder($finder);
