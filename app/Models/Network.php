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
        'provider_id',
        'name',
        'cost',
        'remarks'
    ];

    public function computers() {
        return $this->hasMany(Computer::class, 'network_id');
    }

    public function provider() {
        return $this->belongsTo(Provider::class);
    }

    public function getNetworksByMonthCount($year, $month) {
        return $this->whereMonth('created_at', Carbon::create($year, $month))->count() ?? 0;
    }

    public function getNetworksByProviderCount($provider_id) {
        return $this->where('provider_id', $provider_id)->count() ?? 0;
    }

    public function formattedProvider() {
        return $this->provider()->first()->name ?? '';
    }
}
