[PHPStan](https://phpstan.org/user-guide/getting-started)

Установка за допомогою composer
```
composer require --dev phpstan/phpstan
```

Перший запуск аналітики для папок src та tests
```
php vendor/bin/phpstan analyse [options] [--] [<paths>...]

php vendor/bin/phpstan analyse src tests
php vendor/bin/phpstan analyse -l 5 -c phpstan.neon ./src/

php -d memory_limit=512M vendor/bin/phpstan src tests
```

CI/CD приклад використання
```
#!/bin/bash
vendor/bin/phpstan analyse -c phpstan.neon

if [ $? -eq 0 ]
then
    echo "Successful checks PHPStan"
    exit 0
else
    echo "ERRORS script PHPStan" >&2
    exit 1
fi
```

Приклад рівней
```
Уровень 0: basic checks, unknown classes, unknown functions, unknown methods called on $this, wrong number of arguments passed to those methods and functions, always undefined variables.

Уровень 1: possibly undefined variables, unknown magic methods and properties on classes with __call and __get.

Уровень 2: unknown methods checked on all expressions (not just $this), validating PHPDocs.

Уровень 3: return types, types assigned to properties.

Уровень 4: basic dead code checking - always false instanceof and other type checks, dead else branches, unreachable code after return; etc.

Уровень 5:  checking types of arguments passed to methods and functions.

Уровень 6: report missing typehints

Уровень 7: report partially wrong union types - if you call a method that only exists on some types in a union type, level 7 starts to report that; other possibly incorrect situations

Уровень 8: report calling methods and accessing properties on nullable types

Уровень 9: be strict about the mixed type - the only allowed operation you can do with it is to pass it to another mixed
```

