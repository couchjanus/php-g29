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

        if (count($this->columns) > 0) {
            $query .= implode(', ', $this->columns);
        }else{
            $query .= "*"; 
        }

        $query .= " FROM ";
        $query .= static::$table;

        // var_dump($query);
        // exit();
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

        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if (isset($this->{$property->getName()})) {
                $properties[] = ''.$property->getName().' = "'.$this->{$property->getName()}.'"';
            }
        }
        $setValues = implode(',', $properties);
        $sql = '';
        if($this->id > 0) {
            $sql = 'UPDATE '.static::$table. ' SET '.$setValues. ' WHERE id = '.$this->id;
        } else {
            $sql = 'INSERT INTO '.static::$table. ' SET '. $setValues;
        }

        $stmt = $this->connect->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

    public function first($id) 
    {
        $stmt = $this->connect->prepare($this->select()->where("id='$id'")->query());
        $stmt->execute();
        return $stmt->fetch();
    }

    public function delete($id)
    {
        $condition = "id='$id'";
        $sql = "DELETE FROM ".static::$table." WHERE ".$condition;
        $stmt = $this->connect->prepare($sql);
        return $stmt->execute();
    }
}
