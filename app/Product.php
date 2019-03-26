<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['product_name', 'product_price'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();
    }

    /**
     * Set attribute to null if empty
     * @param $input
     */
    public function setProductPriceAttribute($input)
    {
        $this->attributes['product_price'] = $input ? $input : null;
    }
    
    public function products_customers()
    {
        return $this->belongsToMany(Client::class, 'client_product')->withTrashed();
    }
    
}
