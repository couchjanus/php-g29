<?php

namespace Core;

trait Resizer
{
    // private $obj, $type, $width, $height;

    public function load($fn)
    {
        $object = new \stdClass();

        list($width, $height, $type) = getimagesize($fn);

        if($type == IMAGETYPE_JPEG) {
            $object->image = imagecreatefromjpeg($fn);
        } elseif ($type == IMAGETYPE_PNG) {
            $object->image = imagecreatefrompng($fn);
        }

        return $object;
    }
    
}