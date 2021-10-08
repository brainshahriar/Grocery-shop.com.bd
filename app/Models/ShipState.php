<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;


class ShipState extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function division(){
        return $this->belongsTo(ShipDivision::class,'division_id');
    }
    public function district(){
        return $this->belongsTo(ShipDistrict::class,'district_id');
    }
}
