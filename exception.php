<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Rully Ramanda
 * Date: 04/06/13
 * Time: 12:59
 */

class ThumbnailException extends Exception{
    public function __construct($message = null, $code = 0){
        parent::__construct($message, $code);
        error_log('Error in '.$this->getFile().' Line: '.$this->getLine().' Error: '.$this->getMessage());
    }
}

class ThumbnailFileException extends ThumbnailException{}
class ThumbnailNotSupportedException extends ThumbnailException{}