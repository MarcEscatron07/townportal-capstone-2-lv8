<?php

namespace App\Models;

use App\Models\Status;
use App\Models\Network;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Computer extends Model
{
    use HasFactory;

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

    public function getComputersByStatusCount($status_id) {
        return $this->where('status_id', $status_id)->count() ?? 0;
    }

    public function getComputersByMonthCount($year, $month) {
        return $this->whereMonth('created_at', Carbon::create($year, $month))->count() ?? 0;
    }

    public function formattedNetwork() {
        return $this->network()->first()->name ?? '';
    }

    public function formattedStatus() {
        return $this->status()->first()->name ?? '';
    }
}
