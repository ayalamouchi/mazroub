<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Etudiant extends Model
{
    /** @use HasFactory<\Database\Factories\EtudiantFactory> */
    use HasFactory;
    protected $table = 'etudiants';
    protected $fillable = [
        'institue',
        'cin',
        'localisation',
        'user_id',
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
