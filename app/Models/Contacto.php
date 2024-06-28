<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;
    protected $table = 'contacto_graduados';
    public $timestamps = false;
    protected $fillable = [
        'rrss',
        'url',
        'graduado_id',
    ];
    public function graduado()
    {
        return $this->belongsTo(Graduado::class);
    }
}
