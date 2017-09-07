<?php
require_once('DataBaseMethod.php');
require_once('EnvReader.php');
require_once('Validation.php');
require_once('BotCaller.php');

ini_set( 'display_errors', 1 );

$env_params = EnvReader::getParams('.env');

$hostname = $env_params['HOSTNAME'];
$database_name = $env_params['DATABASE_NAME'];
$user = $env_params['USER'];
$password = $env_params['PASSWORD'];
$table_name = $env_params['TABLE_NAME'];

$parameter = $_POST;

$dbm = new DataBaseMethod($hostname, $database_name, $user, $password, $table_name);

switch ($parameter['function']) {
    case 'insert':
    if (!Validation::paramsValidation($parameter)) {
        exit("エラーが発生しました。\nもう一度やり直してください。error:000");
    }
    $dbm->insert($parameter);
    $bc = new BotCaller($env_params);
    $bc->callBot();
    break;
    
    // case 'update':
    // $dbm->update($parameter);
    // break;
    
    case 'delete':
    $dbm->delete($parameter);
    backToShowPage();
    break;
    
    default:
    exit("エラーが発生しました。\nもう一度やり直してください。error:001");
    break;
}

function backToShowPage()
{
    $url = 'show.php';
    header('Location: ' . $url, true , 301);
    exit;
}