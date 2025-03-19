<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['txt_id', 'status', 'response'];

    public function txt()
    {
        return $this->belongsTo(Txt::class);
    }
}