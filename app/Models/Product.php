<?php
namespace App\Models;

use Core\Entity;

class Product extends Entity
{
    protected static $table = 'products';
    public $id;
    public $name;
    public $price;
    public $description;
    public $image;
    public $status;
    public $brand_id;
    public $category_id;
    public $badge_id;
   
}