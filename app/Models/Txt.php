<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Txt extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['pdf_id','extension','file_path'];
    protected static function boot()
    {
        parent::boot();

        // Excluir o arquivo ou a pasta ao deletar o registro
        static::deleting(function ($txt) {
            if($txt->isForceDeleting()){
                if ($txt->extension === '.zip') {
                    $extractPath = $txt->file_path.'/';
                    if (Storage::disk('public')->exists($extractPath))
                        Storage::disk('public')->deleteDirectory($extractPath);
                } elseif ($txt->extension === '.txt') {
                    if (Storage::disk('public')->exists($txt->file_path))
                        Storage::disk('public')->delete($txt->file_path);
                }
            }
        });
    }
    public function pdf()
    {
        return $this->belongsTo(Pdf::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}