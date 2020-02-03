<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = "detail_pinjam";
    protected $primaryKey = "id";
    protected $fillable = [
      'id_pinjam', 'id_buku', 'qty'
    ];

    public function buku() {
      return $this->belongsTo('App/Buku', 'id_buku');
    }
    public function peminjaman() {
      return $this->belongsTo('App/Pinjam', 'id_pinjam');
    }
}
