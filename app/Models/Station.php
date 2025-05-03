<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Station extends Model
{
    /** @use HasFactory<\Database\Factories\StationFactory> */
    use HasFactory;
    protected $table = 'stations';
    protected $fillable = [
        'adress',
        'lieu',
        'localisation',
        'nombreBus',
    ];
    public function buses():HasMany
    {
        return $this->hasMany(Bus::class, 'station_id');
    }
}
