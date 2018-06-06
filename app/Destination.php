<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
  public function trips()
  {
      return $this->hasMany(Trip::class);
  }
}
