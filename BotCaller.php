<?php
require_once('DataBaseMethod.php');
require_once('EnvReader.php');
require_once('CurlRequest.php');

class BotCaller
{
    private $dbm;
    public $data;
    private $parameters;
    private $keywords;
    
    public function __construct($env_params)
    {
        $this->dbm = new DataBaseMethod($env_params['HOSTNAME'], $env_params['DATABASE_NAME'], $env_params['USER'], $env_params['PASSWORD'], $env_params['TABLE_NAME']);
        $this->data = $this->dbm->show();
        $this->parameters = [
            'name' => $this->getLastRecord()['name'],
            'content' => $this->getLastRecord()['content'],
        ];
        $this->keywords = [
            'しりとり' => $env_params['BOT_URI'] . 'test.php',
            '時間' => $env_params['BOT_URI'] . 'test.php',
            '天気' => $env_params['BOT_URI'] . 'test.php',
            'おみくじ' => $env_params['BOT_URI'] . 'test.php',
        ];
    }
    
    public function callBot()
    {
        foreach ($this->keywords as $key => $value) {
            if ($this->isMatchTag($key) !== false) {
                $client = new CurlRequest($value);
                $result = $client->request($this->parameters, [CURLOPT_RETURNTRANSFER => true]);
                $result = json_decode($result, true);
                $this->insert($result['name'], $result['content']);
                $this->backToShowPage();
            }
        }
        $this->backToShowPage();
    }
    
    public function getLastRecord()
    {
        return end($this->data);
    }
    
    private function isMatchTag($tag)
    {
        if (preg_match('/^' . $tag . '[\s\n]*[\s\S]*$/i', $this->getLastRecord()['content'])) {
            $text = str_replace($tag, '', $this->getLastRecord());
            $text = preg_replace('/^[\s\n]+/u', '', $text);
        } else {
            $text = false;
        }
        return $text;
    }
    
    public function insert($name, $content)
    {
        $params= [
            'name' => $name,
            'content' => $content
        ];
        $this->dbm->insert($params);
    }
    
    function backToShowPage()
    {
        $url = 'show.php';
        header('Location: ' . $url, true , 301);
        exit;
    }
}