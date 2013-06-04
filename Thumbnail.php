<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Rully Ramanda
 * Date: 04/06/13
 * Time: 12:19
 */

class Thumbnail {
    private $maxWidth;
    private $maxHeight;
    private $scale;
    private $inflate;
    private $types;
    private $imgLoaders;
    private $imgCreators;
    private $source;
    private $sourceWidth;
    private $sourceHeight;
    private $sourceMime;
    private $thumb;
    private $thumbWidth;
    private $thumbHeight;

    public function __construct($maxWidth, $maxHeight, $scale = true, $inflate = true){
        $this->maxWidth = $maxWidth;
        $this->maxHeight = $maxHeight;
        $this->scale = $scale;
        $this->inflate = $inflate;
        $this->types = array('image/jpeg', 'image/png', 'image/gif');
        $this->imgLoaders = array(
            'image/jpeg'=>'imagecreatefromjpeg',
            'image/png'=>'imagecreatefrompng',
            'image/gif'=>'imagecreatefromgif',
        );
        $this->imgCreators = array(
            'image/jpeg'=>'imagejpeg',
            'image/png'=>'imagepng',
            'image/gif'=>'imagegif',
        );
    }

    public  function loadFile($image){
        if(!$dims = @getimagesize($image)){
            throw  new ThumbnailFileException('Could not find image '.$image);
        }
        if(in_array($dims['mime'], $this->types)){
            $loader = $this->imgLoaders[$dims['mime']];
            $this->source = $loader($image);
            $this->sourceWidth = $dims[0];
            $this->sourceHeight = $dims[1];
            $this->sourceMime = $dims['mime'];
            $this->initThumb();
            return true;
        }else{
            throw new ThumbnailNotSupportedException('Image MIME type '.$dims['mime'].' not supported');
        }
    }

    public function loadData($image, $mime){
        if(in_array($mime, $this->types)){
            if($this->source = @imagecreatefromstring($image)){
                $this->sourceWidth = imagesx($this->source);
                $this->sourceHeight = imagesy($this->source);
                $this->sourceMime = $mime;
                $this->initThumb();
                return true;
            }else{
                throw new ThumbnailFileException('Could not load image from string');
            }
        }else{
            throw new ThumbnailNotSupportedException('Image MIME type '.$mime.' not supported');
        }
    }

    public  function buildThumb($file = null){
        $creator = $this->imgCreators[$this->sourceMime];
        if(isset($file)){
            return $creator($this->thumb, $file);
        }else{
            return $creator($this->thumb);
        }
    }

    public function getMime(){
        return $this->sourceMime;
    }

    public function getThumbHeight()
    {
        return $this->thumbHeight;
    }

    public function getThumbWidth()
    {
        return $this->thumbWidth;
    }

    private function initThumb(){
        if($this->scale){
            if($this->sourceWidth > $this->sourceHeight){
                $this->thumbWidth = $this->maxWidth;
                $this->thumbHeight = floor($this->sourceHeight * ($this->maxWidth / $this->sourceWidth));
            }elseif($this->sourceWidth < $this->sourceHeight){
                $this->thumbHeight = $this->maxHeight;
                $this->thumbWidth = floor($this->sourceWidth * ($this->maxHeight / $this->sourceHeight));
            }else{
                $this->thumbWidth = $this->maxWidth;
                $this->thumbHeight = $this->maxHeight;
            }
        }else{
            $this->thumbWidth = $this->maxWidth;
            $this->thumbHeight = $this->maxHeight;
        }

        $this->thumb = imagecreatetruecolor($this->thumbWidth, $this->thumbHeight);

        if($this->sourceWidth <= $this->maxWidth && $this->sourceHeight <= $this->maxHeight && $this->inflate == false){
            $this->thumb = $this->source;
        }else{
            imagecopyresampled($this->thumb, $this->source, 0, 0, 0, 0, $this->thumbWidth, $this->thumbHeight,
            $this->sourceWidth, $this->sourceHeight);
        }
    }
}