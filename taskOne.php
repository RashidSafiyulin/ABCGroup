<?php
/**
 *  Задача No 1:
 *      Формирование csv файла из массива.
 */

$file = 'out.csv';
if(file_exists($file)) {
    if (!is_writable($file)) {
        echo('Файл ' . $file . ' существует, но не доступен для записи.' . PHP_EOL);
        return;
    }
    $answer = readline('Файл ' . $file . ' существует. Перезаписать (Y/N)? ' . PHP_EOL);
    if (strtoupper(substr(trim($answer), 0, 1)) !== 'Y') {
        echo('$answer = "' . strtoupper(substr(trim($answer), 0, 1)) . '"' . PHP_EOL);
        echo(ord(strtoupper(substr(trim($answer), 0, 1))) . ' - ' . ord('Y'));
        return;
    }
}

error_reporting(E_ALL & ~E_WARNING);
$handle = fopen($file, 'w');
error_reporting(E_ALL);
if (!$handle) {
    echo('Ошибка открытия ' . $file . '.' . PHP_EOL);
    return;
}

$data = [
    [
        'country_name' => 'USA',
        'country_code' => 'US',
        'city_name' => 'New York',
        'lat' => '40.7127753',
        'lng' => '-74.0059728',
    ],
    [
        'country_name' => 'USA',
        'country_code' => 'US',
        'city_name' => 'Los Angeles',
        'lat' => '34.0522342',
        'lng' => '-118.2436849',
    ],
    [
        'country_name' => 'Philippines',
        'country_code' => 'PH',
        'city_name' => 'Manila',
        'lat' => '14.5995124',
        'lng' => '120.9842195',
    ],
    [
        'country_name' => 'Philippines',
        'country_code' => 'PH',
        'city_name' => 'Cebu',
        'lat' => '10.3156993',
        'lng' => '123.8854377',
    ]
];

fputs($handle, implode(',', ['Country name', 'Country code', 'Lat', 'Long']) . PHP_EOL); // Согласно результату описанному в ТЗ
/*
 Однако более правильно сделать это через fputcsv с экрованированием
    fputcsv($handle, ['Country name', 'Country code', 'Lat', 'Long']);
   с таким результатом заголовка:
    "Country name","Country code",Lat,Long
*/
foreach($data as $city) {
    fputcsv($handle, $city);
}
echo('Результаты в файле ' . realpath($file) . PHP_EOL);
fclose($handle);