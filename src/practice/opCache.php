<?php

// Кеш опкодів.

// Зберігає скомпільований скриптовий байт-код в памʼяті.
// Коли скріпт запускається повторно, OPCache використовує кешований
// байт-код замість повторної компіляції вихідного коду

// Це значно прешвидшує виконання скрипта, так як операції компиляції
// потребує значних ресурсів.

// Перед використання треба впевнитись, що він налаштован та включен
// OPCache в php.ini налаштування основних опцій по відокремленії памʼяті та макс. кількості файлов в кешувані
// https://www.php.net/manual/ru/opcache.configuration.php
// opcache.memory_consumption=128
// opcache.interned_strings_buffer=8
// opcache.max_accelerated_files=4000
// opcache.revalidate_freq=60
// opcache.fast_shutdown=1 ; до PHP 7.2.0
// opcache.enable_cli=1

// !!! Якщо бажаєте використовувати OPcache з Xdebug, тоді спершу треба завантажити OPcache, а потім Xdebug.

// var_dump(opcache_get_status());
// var_dump(opcache_get_configuration());

// php --ri 'Zend OPcache'

# https://laravel-news.com/php-opcache-docker
# [opcache]
# opcache.enable=1
# ; 0 means it will check on every request
# ; 0 is irrelevant if opcache.validate_timestamps=0 which is desirable in production
# opcache.revalidate_freq=0
# opcache.validate_timestamps=1 # allows to make changes to code
# opcache.max_accelerated_files=10000
# opcache.memory_consumption=192
# opcache.max_wasted_percentage=10
# opcache.interned_strings_buffer=16
# opcache.fast_shutdown=1
