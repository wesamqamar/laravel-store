<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'category_id',
        'store_id',
        'price',
        'compare_price',
        'status'
    ];

    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope());
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'product_tag',
            'product_id',
            'tag_id',
            'id',
            'id',
        );
    }

    public function scopeActive(EloquentBuilder $builder){
        $builder->where('status', '=', 'active');
    }

    //Accessors

    // public function get(Attribute name)Attribute(){

    // }

    public function getImageUrlAttribute(){
    if (!$this->image) {
        return 'https://www.mobismea.com/upload/iblock/2a0/2f5hleoupzrnz9o3b8elnbv82hxfh4ld/No Product Image Available.png';
    }
    if (  Str::startsWith($this->image , ['http://' , 'https://']) ) {
            return $this->image;
    }
        return asset('storage/' . $this->image);

}
    public function getSalePercentAttribute(){
    if (!$this->compare_price) {
        return 0 ;
    }

        return number_format(100 - (100* $this->price /$this->compare_price),1);

}

}
