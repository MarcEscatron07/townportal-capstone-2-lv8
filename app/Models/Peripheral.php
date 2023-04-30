<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peripheral extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'peripherals';

    protected $fillable = [
        'computer_id',
        'type_id',
        'name',
        'brand',
        'model',
        'serial_number',
        'cost',
        'remarks'
    ];

    public function computer() {
        return $this->belongsTo(Computer::class);
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }
}
