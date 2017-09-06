<?php
define("NAME_LENGTH", 20);
define("CONTENT_LENGTH", 200);
class Validation
{
    public static function paramsValidation($params)
    {
        if (self::isAllAllowable($params)) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function isLengthAllowable($text, $length)
    {
        return (mb_strlen($text) <= $length);
    }
    
    private static function isAllAllowable($params)
    {
        $flag = true;
        if (!self::isLengthAllowable($params['name'], NAME_LENGTH)) {
            $flag = false;
        }
        
        if (!self::isLengthAllowable($params['content'], CONTENT_LENGTH)) {
            $flag = false;
        }
        return $flag;
    }
}