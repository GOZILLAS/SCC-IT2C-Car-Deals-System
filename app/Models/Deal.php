<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
    'car_name', 
    'brand_name', 
    'price', 
    'car_serial', 
    'payment_method_id', 
    'deal_statuses_id'
];

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function dealStatus(){
        return $this->belongsTo(DealStatus::class);
    }

}
