<?php

namespace Modules\Advertisement\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Modules\Advertisement\Database\Factories\ClientFactory;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        // Client Details
        'name',
        'email',
        'phone',
        'alternate_phone',
        'address',

        // Company Details
        'company_name',
        'company_email',
        'company_phone',
        'company_pan',
        'company_address',
        'company_logo',

        // Owner Details
        'owner_name',
        'owner_email',
        'owner_phone',
        'owner_image',
        'owner_address',

        'status',
    ];

    // protected static function newFactory(): ClientFactory
    // {
    //     // return ClientFactory::new();
    // }
}
