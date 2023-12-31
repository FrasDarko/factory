<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractList extends Model
{
    use HasFactory;

    protected $table = "contract_lists";
    protected $fillable = ["name", "description"];
}
