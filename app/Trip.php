<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
  public function destination()
  {
      return $this->belongsTo(Destination::class);
  }
}
