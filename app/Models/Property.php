<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_type',
        'rental_start_date',
        'rental_end_date',
        'property_type',
        'name',
        'description',
        'price',
        'furnished',
        'bedrooms',
        'bathrooms',
        'building_area',
        'land_area',
        'garage',
        'province',
        'city',
        'district',
        'address',
        'gmaps_link',
        'image',
        'other_links',
        'user_id',  // tambahkan user_id
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
