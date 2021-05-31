<?php
namespace App\Models;

class ResponseModel
{
    public $Data;
    public $Message;
    public $ResponseCode;

    public function __construct($Data,$Message,$ResponseCode){
        $this->Data = $Data;
        $this->Message = $Message;
        $this->ResponseCode = $ResponseCode;
    }
}