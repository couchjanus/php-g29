<?php
namespace App\Models;

use Core\Entity;

class Section extends Entity
{
    protected static $table = 'sections';
    public $id;
    public $name;
   
}