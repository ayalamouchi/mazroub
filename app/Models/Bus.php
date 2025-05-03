<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    /** @use HasFactory<\Database\Factories\BusFactory> */
    use HasFactory;
    protected $table = 'buses';
    protected $fillable = [
        'horaireDep',
        'horaireArr',
        'distance',
        'adress',
        'lieu',
        'numeroBus',
        'point1',
        'point2',
        'point3',
        'point4',
        'point5',
        'station_id', // Clé étrangère
    ];
    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id');
    }
}
