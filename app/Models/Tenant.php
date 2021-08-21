<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Tenant extends Model
{
    
    use HasFactory;

    protected $fillable = [
        // 'name',
        // 'email',
        'user_id',
        'phone',
    ];

    public function users(){

        return $this->belongsTo(User::class, 'id');

    }
}
