<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pekerja extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_pekerja', 'no_pekerja', 'lama_kerja'
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
