<?php
namespace Core\Traits;

trait Upload 
{

	private function fileName()
    {
        return sha1(mt_rand(1, 9999).$this->generateRandomString().uniqid()).time();
    }
    
    
    // генерувати випадковий рядок
    private function generateRandomString($length = 10) 
    {
        // generateRandomString();  // OR: generateRandomString(24)
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }


    public function save($image, $path='', $type=IMAGETYPE_JPEG, $quality=80) {
        
        $filename = $this->fileName('name');
        
        $new_filename = STORAGE.$path.$filename;
        
        if( $type == IMAGETYPE_JPEG ) {
            imagejpeg($image, $new_filename, $quality);
         }
         elseif( $type == IMAGETYPE_PNG ) {
            imagepng($image, $new_filename);
         }
         elseif( $type == IMAGETYPE_GIF ) {
            imagegif($image, $new_filename);
         }

         unset($image);

         return "http://".$_SERVER['HTTP_HOST'].MEDIA.$path.$filename;
    }


    public function upload($data, $path='') {
    
        if(!empty($data)){
            $filename = $this->fileName();
            if(move_uploaded_file($data['tmp_name'], STORAGE.$path.$filename)){
                return "http://".$_SERVER['HTTP_HOST'].MEDIA.$path.$filename;
            }
        }
        return false;

    }
}