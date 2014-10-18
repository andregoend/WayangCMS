<?php

namespace system\core;

use system\core\Base as Base;
use system\core\Reflector as Reflector;

class Model extends Base
{
	protected $table;
    protected $registry;
    protected $db;
    protected $types = array(
        'autonumber',
        'text',
        'integer',
        'decimal',
        'boolean',
        'datetime',
    );
    protected $columns;
    protected $primary;
    
    public function getTable()
    {
        return $this->table;
    }
    
    public function getDb()
    {
        if(empty($this->db)){
            if(!isset($this->registry['db'])){
                throw new \Exception('No Database connected');
            }
            
            $this->db = $this->registry['db'];
            
            return $this->db;
        }
    }
    
    public function getColumns()
    {
        if(empty($this->columns)){
            $primaries = 0;
            $columns = array();
            $class = get_class($this);
            $types = $this->types;
            
            $reflector = new Reflector($this);
            $properties = $reflector->getClassProperties();
            $first = function($array, $key){
                if(!empty($array[$key]) && count($array[$key]) == 1){
                    return $array[$key][0];
                }
                return null;
            };
            
            foreach($properties as $property){
                $propertyMeta = $reflector->getPropertyMeta($property);
                if(!empty($propertyMeta['@column'])){
                    $name = preg_replace("#^_#", "", $property);
                    $primary = !empty($propertyMeta, '@primary');
                    $type = $first($propertyMeta, '@type');
                    $length = $first($propertyMeta, '@length');
                    $index = !empty($propertyMeta['@index']);
                    $validate = !empty($propertyMeta['@validate']) ? $propertyMeta['@validate'] : false;
                    $label = $first($propertyMeta, '@label');
                    
                    if(!in_array($type, $types)){
                        throw new \Exception("{$type} is not a valid type");
                    }
                    
                    if($primary){
                        $primaries++;
                    }
                    
                    $columns[$name] = array(
                        'raw' => $property,
                        'name' => $name,
                        'primary' => $primary,
                        'type' => $type,
                        'length' => $length,
                        'index' => $index,
                        'validate' => $validate,
                        'label' => $label,
                    );
                }
            }
            
            if($primaries !== 1){
                throw new \Exception("{$class} must have have excactly one @primary column");
            }
            
            $this->columns = $columns;
        }
        
        return $this->columns;
    }
    
    public function getColumn($name)
    {
        if(!empty($this->columns[$name])){
            return $this->columns[$name];
        }
        return null;
    }
    
    public function getPrimaryColumn()
    {
        if(!isset($this->primary)){
            $primary = null;
            foreach($this->columns as $column){
                if($column['primary']){
                    $primary = $column;
                    break;
                }
            }
            $this->primary = $primary;
        }
        return $this->primary;
    }
}