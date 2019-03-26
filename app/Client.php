<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();
    }
    
    public function customer_product()
    {
        return $this->belongsToMany(Product::class, 'client_product')->withTrashed();
    }
    
}
