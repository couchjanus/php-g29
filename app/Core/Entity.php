<?php 
namespace Core;

abstract class Entity
{
    protected static $table;

    protected $connect;

    private $columns;

    public function __construct()
    {
        $this->connect = Connection::connect();
    }

    public function select($columns = [])
    {
        $this->columns = $columns;
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
}
