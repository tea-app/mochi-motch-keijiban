<?php
/*
 * $paeametersにはクエリとして渡したいパラメータを配列で渡す
 * $opt_arrayにはcurl_opt()関数に渡したいオプションを配列で渡す
 */
class CurlRequest
{
    function __construct($uri)
    {
        $this->uri = $uri;
    }
    public function request($parameters, $opt_array)
    {
        $ch = curl_init($this->uri . '?' . http_build_query($parameters));
        if ($opt_array !== null) {
            curl_setopt_array($ch, $opt_array);
        }
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}