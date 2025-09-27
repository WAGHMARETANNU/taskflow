<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registrations extends Model
{
    protected $table = 'registration';
    
    protected $fillable = [
        'fname',
        'email', 
        'password',
        'mobile',
        'gender',
        'edu',
        'profile_picture', // Changed from 'file' to 'profile_picture'
        'token',
        'status',
        'role'
    ];
    
    // If you don't have created_at and updated_at columns, add this:
    public $timestamps = false;
    
    // Or if you do have timestamps but with different names, specify them:
    // const CREATED_AT = 'created_at';
    // const UPDATED_AT = 'updated_at';
}
