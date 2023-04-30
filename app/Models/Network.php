<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    use HasFactory;

    protected $table = 'networks';

    protected $fillable = [
        'name',
        'provider',
        'cost',
        'remarks'
    ];

    public function computers() {
        return $this->hasMany(Computer::class, 'network_id');
    }
}
