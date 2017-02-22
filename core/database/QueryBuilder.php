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

    public function insert($table,$parameters)
    {
        $sql=sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ',array_keys($parameters)),
            ':'.implode(', :',array_keys($parameters))
        );

        try{
            $statment=$this->pdo->prepare($sql);
            $statment->execute($parameters);
        }catch(Exception $e){
            die("Whoops!,something went wrong ".$e->getMessage());
        }
    }

    public function update($table,$fields,$condition)
    {
        $fieldsKV=implode(',',array_map_assoc(function($k,$v){return "$k = $v";},$fields));
        $conditionKV=implode('and',array_map_assoc(function($k,$v){return "$k = $v";},$condition));
        $sql=sprintf(
            'update %s set %s where %s',
            $table,
            $fieldsKV,
            $conditionKV
        );

        try{
            $statment=$this->pdo->prepare($sql);
            $statment->execute();
        }catch(Exception $e){
            die("Whoops!,something went wrong ".$e->getMessage());
        }
    }

    public function delete($table,$condition)
    {
        $conditionKV=implode('and',array_map_assoc(function($k,$v){return "$k = $v";},$condition));
        $sql=sprintf(
            'delete from %s where %s',
            $table,
            $conditionKV
        );

        try{
            $statment=$this->pdo->prepare($sql);
            $statment->execute();
        }catch(Exception $e){
            die("Whoops!,something went wrong ".$e->getMessage());
        }
    }

    public function select($table,$fields,$condition)
    {
        $conditionKV=implode('and',array_map_assoc(function($k,$v){return "$k = $v";},$condition));
        $sql=sprintf(
            'select %s from %s where %',
            implode(', ',$fields),
            $table,
            $conditionKV
        );

        try{
            $statment=$this->pdo->prepare($sql);
            $statment->execute();
            return $statment->fetchAll(PDO::FETCH_CLASS);
        }catch(Exception $e){
            die("Whoops!,something went wrong ".$e->getMessage());
        }
    }

    protected function array_map_assoc( $callback , $array ){
        $r = array();
        foreach ($array as $key=>$value)
            $r[$key] = $callback($key,$value);
        return $r;
    }
}
