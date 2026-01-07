<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
    protected $fillable = [
        'slims_member_id',
        'name',
        'email',
        'phone',
        'address',
        'type',
        'register_date',
        'expire_date',
        'image',
    ];
}
