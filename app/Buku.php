<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
  protected $table = 'buku';
  protected $primarykey = 'id';
  protected $fillable = [
    'judul', 'penerbit', 'pengarang', 'stok', 'foto'
  ];

  public function detail(){
    return $this->hasMany('App\Detail','id');
  }
}
