<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    // definisi properti yang diperlukan
    public $status;
    public $message; 
    public $resource; 

    /**
     * buat __construct untuk mengkonstruktor
     * 
     * @param mixed $status
     * @param mixed $message
     * @param mixed $resource
     * @return void
     */

    //  parameter construct dibuat dan akan mengirimkan sebuah nilai properti
     public function __construct($status, $message, $resource)
     {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
     }

     /**
      * Transformasikan ke array
      * 
      * @param \Illuminate\Http\Request
      * @return array
      */

    //   transformasi ke dalam bentuk array dan JSON
      public function toArray($request)
      {
        return [
            'success' => $this->status,
            'message' => $this->message,
            'data' => $this->resource,
        ];
      }
}
