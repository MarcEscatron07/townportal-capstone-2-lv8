<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    public function getNetworksByMonthCount($year, $month) {
        return $this->whereMonth('created_at', Carbon::create($year, $month))->count();
    }

    public function getNetworksByProviderCount($provider) {
        return $this->where('provider', $provider)->count();
    }
}
