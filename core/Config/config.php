<?php

$config = [
    'database' => json_decode(file_get_contents(
        realpath(__DIR__ . '/database.json')
    )),
    'errors' => json_decode(file_get_contents(
        realpath(__DIR__ . '/errors.json')
    ), true),
    'defaults' => json_decode(file_get_contents(
        realpath(__DIR__ . '/defaults.json')
    )),
    'router' => json_decode(file_get_contents(
        realpath(__DIR__ . '/router.json')
    ), true)
];