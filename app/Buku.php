<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
  protected $table = 'buku';
  protected $primarykey = 'id';
  public $timestamps = false;
}
