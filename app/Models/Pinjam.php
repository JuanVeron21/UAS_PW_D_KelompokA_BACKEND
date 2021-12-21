<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pinjam extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_peminjam','npm','judul_buku'
    ];

    protected function getCreatedAtAttribute()
    {
        if(!is_null($this->attributes['created_at']))
        {
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    protected function getUpdatedAtAttribute()
    {
        if(!is_null($this->attributes['updated_at']))
        {
            return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
        }
    }
}
