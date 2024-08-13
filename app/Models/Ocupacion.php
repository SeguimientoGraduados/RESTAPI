<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ocupacion extends Model
{
    use HasFactory;
    protected $table = 'ocupacion_graduados';
    public $timestamps = false;
    protected $fillable = [
        'graduado_id',
        'ocupacion_trabajo',
        'ocupacion_empresa',
        'ocupacion_sector',
        'ocupacion_informacion_adicional',
    ];

    public function graduado()
    {
        return $this->belongsTo(Graduado::class);
    }
}
