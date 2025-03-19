<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'permissions';
    protected $fillable = ['name','description'];
    // Relação muitos-para-muitos com Profile
    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_permission');
    }
}
