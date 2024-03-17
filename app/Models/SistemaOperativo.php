<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SistemaOperativo extends Model
{
    use HasFactory;

    protected $table = 'sistema_operativo';

    protected $fillable = ['nombre'];

    public function softwares()
    {
        return $this->hasMany(Software::class, 'so_id');
    }
}
