<?php
class QueryBuilder{
    protected $pdo;
    function __construct(PDO $pdo)
    {
        $this->pdo=$pdo;
    }
    public function selectAll($table)
    {
        $statment=$this->pdo->prepare("select * from ${table}");
        $statment->execute();
        return $statment->fetchAll(PDO::FETCH_CLASS);
    }
}
