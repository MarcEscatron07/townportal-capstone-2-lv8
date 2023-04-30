<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Computer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'computers';

    protected $fillable = [
        'status_id',
        'network_id',
        'name',
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
