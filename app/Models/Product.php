<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'stock',
        'cost',
        'remarks'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function getProductsByCategoryCount($category_id) {
        return $this->where('category_id', $category_id)->count();
    }

    public function getProductsByMonthCount($year, $month) {
        return $this->whereMonth('created_at', Carbon::create($year, $month))->count();
    }
}
