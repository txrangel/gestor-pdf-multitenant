<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'profiles';
    protected $fillable = ['name','description'];
    // Relação muitos-para-muitos com User
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_profile');
    }

    // Relação muitos-para-muitos com Permission
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'profile_permission');
    }
}
