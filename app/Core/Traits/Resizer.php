<?php
namespace Core\Traits;

trait Resizer 
{


    public function load($filename)
    {
        $object = new \stdClass();
        
        list($object->width, $object->height, $object->type) = getimagesize($filename);

        if( $object->type == IMAGETYPE_JPEG ) {
            $object->image = imagecreatefromjpeg($filename);
        } elseif( $object->type == IMAGETYPE_GIF ) {
            $object->image = imagecreatefromgif($filename);
        } elseif( $object->type == IMAGETYPE_PNG ) {
            $object->image = imagecreatefrompng($filename);
        }
        return $object;
    }

    public function resize($w, $h, $source) {
        $image = imagecreatetruecolor($w, $h);
        imagecopyresampled($image, $source->image, 0, 0, 0, 0, $w, $h, $source->width, $source->height);
        return $image;
    }

    public function resize_width($w, $source) {
        $ratio = $w / $source->width;
        $h = $source->height * $ratio;
        return $this->resize($w, $h, $source);
    }

    public function resize_height($h, $source) {
        $ratio = $h / $source->height;
        $w = $source->width * $ratio;
        return $this->resize($w, $h, $source, $source->width, $source->height);
    }

    public function scale($scale, $source) {
        $w = $source->width * $scale;
        $h = $source->height * $scale;
        return $this->resize($w, $h, $source, $source->width, $source->height);
    }

}