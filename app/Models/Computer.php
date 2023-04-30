<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    protected $table = 'computers';

    protected $fillable = [
        'status_id',
        'network_id',
        'name',
        'unit',
        'remarks'
    ];

    public function peripherals() {
        return $this->hasMany(Peripheral::class, 'computer_id');
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function network() {
        return $this->belongsTo(Network::class);
    }
}
