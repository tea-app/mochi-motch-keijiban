<?php
require_once('DataBaseMethod.php');
require_once('EnvReader.php');

ini_set( 'display_errors', 1 );

$env_params = EnvReader::getParams('.env');

$dbm = new DataBaseMethod($env_params['HOSTNAME'], $env_params['DATABASE_NAME'], $env_params['USER'], $env_params['PASSWORD'], $env_params['TABLE_NAME']);

$data = $dbm->show();

foreach ($data as $i => $record) {
    echo "<pre>";
    echo $i . "\n";
    echo $record['created_at'] . "\n";
    echo $record['name'] . "\n";
    echo $record['content'] . "\n";
    echo "</pre>";
}