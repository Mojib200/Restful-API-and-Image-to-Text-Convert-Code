<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{ protected $table = 'homes';
    use HasFactory;
    protected $guarded = [''];
}
