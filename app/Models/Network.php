<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Network extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'networks';

    protected $fillable = [
        'name',
        'isp',
        'cost',
        'remarks'
    ];

    public function computers() {
        return $this->hasMany(Computer::class, 'network_id');
    }
}
