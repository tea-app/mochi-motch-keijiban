<?php
class DataBaseMethod
{
    private $hostname;
    private $database_name;
    private $user;
    private $password;
    private $table_name;
    private $dbh;
    
    function __construct($hostname, $database_name, $user, $password, $table_name)
    {
        $this->hostname = $hostname;
        $this->database_name = $database_name;
        $this->user = $user;
        $this->password = $password;
        $this->table_name = $table_name;
        $this->init();
    }
    
    private function init()
    {
        try {
            $this->dbh = new PDO('mysql:host=' . $this->hostname . ';dbname=' . $this->database_name . ';charset=utf8', $this->user, $this->password, [PDO::ATTR_EMULATE_PREPARES => false]);
        } catch (PDOException $e) {
            exit("データベース接続失敗。\n" . $e->getMessage());
        }
    }
    
    public function insert($parameter)
    {
        $sth = $this->dbh->prepare('insert into ' . $this->table_name . ' (name, content) values (:name, :content);');
        $sth->bindParam(':name', $parameter['name'], PDO::PARAM_STR);
        $sth->bindParam(':content', $parameter['content'], PDO::PARAM_STR);
        return $sth->execute();
    }
    
    public function show()
    {
        $sth = $this->dbh->prepare('select * from ' . $this->table_name . ';');
        $sth->execute();
        return $sth->fetchAll();
    }
    
    public function update($parameter)
    {
        $sth = $this->dbh->prepare('update ' . $this->table_name . ' set name = :name, content = :content where id = :id;');
        $sth->bindParam(':id', $parameter['id'], PDO::PARAM_INT);
        $sth->bindParam(':name', $parameter['name'], PDO::PARAM_STR);
        $sth->bindParam(':content', $parameter['content'], PDO::PARAM_STR);
        $sth->execute();
        if ($sth->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }
    
    public function delete($parameter)
    {
        $parameter['content'] = '削除されました。';
        return $this->update($parameter);
    }
}
