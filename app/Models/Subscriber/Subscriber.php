<?php

namespace App\Models\Subscriber;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;
    protected $fillable = ['compte', 'raisonsociale', 'ste_part', 'responsable', 'telephone', 'email', 'groupement'];
}
