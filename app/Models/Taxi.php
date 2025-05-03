<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Taxi extends Model
{
    /** @use HasFactory<\Database\Factories\TaxiFactory> */
    use HasFactory;
    protected $table = 'taxis';
    // definir matricule comme clé primaire
    protected $primaryKey = 'martricule';
    //desactiver l'auto incrementation
    public $incrementing = false;
    // definir le type de la clé primaire
    protected $keyType = 'string';
    protected $fillable = [
        'martricule',
        'zonedetravaill',
        'disponibilite',
        'station',
        'user_id',
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
