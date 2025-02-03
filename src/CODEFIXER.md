[PHPCodeSnifer](https://cs.symfony.com/)

[PHPCodeSniferUsage](https://cs.symfony.com/doc/usage.html)


По дефолту використовається форматування PSR-12
```
composer require friendsofphp/php-cs-fixer

php vendor/bin/php-cs-fixer fix .
```


Налаштування правил форматування під час запуску
```
php-cs-fixer fix /path/to/project --rules=@PSR2, full_opening_tag, indentation_type
```


Або стоврення конфігураційного файлу в корні каталогу
```
php vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php


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
```
