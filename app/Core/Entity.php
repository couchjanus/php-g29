<?php 
namespace Core;

abstract class Entity
{
    protected static $table;

    protected $connect;

    private $columns;

    private $where;

    public function __construct()
    {
        $this->connect = Connection::connect();
    }

    // $_ = fn($v){return($v);};

    public function select($columns = [])
    {
        $this->columns = $columns;
        return $this;
    }

    private function where($where)
    {
        $this->where = $where;
        return $this;
    }

    private function query()
    {
        $query = "SELECT ";
        
        if(count($this->columns) > 0) {
            $query .= implode(", ", $this->columns);
        }else{
            $query .= "*";
        }

        

        $query .= " FROM ";
        $query .= static::$table;

        if (!empty($this->where)) {
            $query .= " WHERE ";
            $query .= $this->where;
        }

        return $query;
    }

    public function get() 
    {
        $stmt = $this->connect->prepare($this->query());
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function save()
    {
        $class = new \ReflectionClass($this);
        $properties = [];
        
        $_ = fn($v) => ($v);

        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property){
            if (isset($this->{$property->getName()})){
                $properties[] = ''.$property->getName().' = "'.$this->{$property->getName()}.'"';
            }
        }

        $setValues = implode(',', $properties);
        $sql = '';
        if($this->id > 0) {
            $sql = 'UPDATE '.static::$table. ' SET '. $setValues. ' WHERE id = ' .$this->id;

            // dd($sql);
            
        } else{
            // $sql = 'INSERT INTO '.static::$table. ' SET '. $setValues;
            $sql = "INSERT INTO {$_(static::$table)} SET $setValues";
            
        }
        $stmt = $this->connect->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

    public function first($id) 
    {
        // $stmt = $this->connect->prepare($this->where("id='$id'")->query());
        $stmt = $this->connect->prepare($this->select()->where("id='$id'")->query());
        $stmt->execute();
        return $stmt->fetch();
    }

    public function delete($id) {

        $condition = "id='$id'";

        $sql = "DELETE FROM ".static::$table." WHERE ". $condition;
        $stmt = $this->connect->prepare($sql);
        return $stmt->execute();
    }

    public function findBy($condition) {
        $stmt = $this->connect->prepare($this->select()->where($condition)->query());
        $stmt->execute();
        return $stmt->fetch();
    }

    public function find($condition, $fields=[]) {
        
        $stmt = $this->connect->prepare($this->select($fields)->where($condition)->query());
        $stmt->execute();
        return $stmt->fetch();
    }

}
