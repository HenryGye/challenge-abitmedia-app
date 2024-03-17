<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licencia extends Model
{
    use HasFactory;

    protected $table = 'licencias';

    protected $fillable = ['serial', 'software_id'];

    public function software()
    {
        return $this->belongsTo(Software::class, 'software_id', 'id');
    }
}
