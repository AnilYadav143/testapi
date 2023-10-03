<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
    'p_name',
    'p_categry_id',
    'p_description',
    'p_type_id',
    'p_variation',
    'p_var_value',
    'p_price',
    'p_qty',
    'p_discout_type',
    'p_discout',
    'p_image',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'p_categry_id','id');
    }
    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'p_type_id','id');
    }
}
