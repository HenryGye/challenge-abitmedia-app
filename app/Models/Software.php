<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    use HasFactory;

    protected $table = 'softwares';

    protected $fillable = ['sku', 'nombre', 'precio', 'stock', 'so_id'];

    public function sistemaOperativo() {
        return $this->belongsTo(SistemaOperativo::class, 'so_id');
    }

    public function licencia() {
        return $this->hasOne(Licencia::class);
    }
}
