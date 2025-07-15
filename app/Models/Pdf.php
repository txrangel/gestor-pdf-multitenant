<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Pdf extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name', 'file_path','user_id'];
    protected static function boot()
    {
        parent::boot();
    
        // Excluir o arquivo do storage e os TXTs relacionados ao deletar o registro de PDF
        static::deleting(function ($pdf) {
            if($pdf->isForceDeleting()){
                // Excluir o arquivo PDF
                if (Storage::disk('public')->exists($pdf->file_path)) {
                    Storage::disk('public')->delete($pdf->file_path);
                }
        
                // Excluir os arquivos TXT relacionados
                foreach ($pdf->txts as $txt) {
                    if (Storage::disk('public')->exists($txt->file_path)) {
                        Storage::disk('public')->delete($txt->file_path);
                    }
                    $txt->delete(); // Excluir o registro de TXT
                }
            }
        });
    }
    public function txts()
    {
        return $this->hasMany(Txt::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}