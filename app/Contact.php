<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{
  use Notifiable;
  protected $fillable = [
      'name', 'email', 'telephone','enquiry_details'
  ];

  public function routeNotificationForMail()
   {
       return $this->email;
   }
}
