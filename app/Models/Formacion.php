<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formacion extends Model
{
    use HasFactory;
    protected $table = 'formacion_graduados';
    public $timestamps = false;
    protected $fillable = [
        'titulo',
        'institucion',
        'nivel',
        'graduado_id',
    ];
    public function graduado()
    {
        return $this->belongsTo(Graduado::class);
    }
}
