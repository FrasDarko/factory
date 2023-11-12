<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table = "users";
    protected $fillable = ["firstName", "lastName", "email", "phone", "address", "city", "country"];
}
