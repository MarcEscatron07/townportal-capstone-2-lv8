<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peripheral extends Model
{
    use HasFactory;

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

    public function getPeripheralsByMonthCount($year, $month) {
        return $this->whereMonth('created_at', Carbon::create($year, $month))->count();
    }

    public function getPeripheralsByTypeCount($type_id) {
        return $this->where('type_id', $type_id)->count();
    }
}
