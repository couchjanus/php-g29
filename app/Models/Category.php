<?php
namespace Models;

use Core\Entity;

class Category extends Entity
{
    protected static $table = 'categories';
    public $id;
    public $name;
    public $section_id;
    public $cover;
   
}