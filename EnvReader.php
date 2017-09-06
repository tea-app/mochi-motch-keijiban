<?php
class EnvReader
{
    public static function getParams($path)
    {
        $textArray = self::readFile($path);
        $params = [];
        foreach ($textArray as $text) {
            $params += [preg_split('/=/', $text)[0] => preg_split('/=/', $text)[1]];
        }
        return $params;
    }
    
    private function readFile($path)
    {
        $textArray = file($path, FILE_USE_INCLUDE_PATH | FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        return $textArray;
    }
}
// echo '<pre>';
// var_dump(EnvReader::getParams('.env'));
// echo '</pre>';
