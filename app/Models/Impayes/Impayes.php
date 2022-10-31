<?php

namespace App\Models\Impayes;

use App\Models\Subscriber\Subscriber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impayes extends Model
{
    use HasFactory;
    protected $table = "impayes";
    protected $fillable = [
        'exercice',
        'quitance',
        'cie',
        'souscripteur',
        'branche',
        'categorie',
        'risque',
        'police',
        'du',
        'au',
        'mtt_ancaiss',
        'ref_encaiss',
        'aperiteur',
        'prime_total',
    ];


    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}
