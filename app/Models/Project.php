<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function feature(){
        return $this->hasMany(Feature::class);
    }

    public function additional_cost(){
        return $this->hasMany(AdditionalCost::class);
    }
}
