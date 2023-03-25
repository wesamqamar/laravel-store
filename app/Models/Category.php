<?php

namespace App\Models;

use App\Rules\Fillter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory , SoftDeletes;



    protected $fillable = [
        'name',
        'parent_id',
        'description',
        'status',
        'image',
        'slug'
    ];

    public function products(){
        return $this->hasMany(Product::class ,'category_id','id');
    }
    public function parent(){
        return $this->belongsTo(Category::class , 'parent_id','id')
        ->withDefault([
            'name'=>'--'
        ]);
    }
    public function children(){
        return $this->hasMany(Category::class , 'parent_id','id');
    }

    public function scopeFilter( Builder $builder , $filters)
    {
        if($filters['name'] ?? false){
            $builder->where('name', 'LIKE' , "%{$filters['name']}%");
         }

         if($filters['status'] ?? false){
            $builder->where('status', '=' , $filters['status']);
         }

    }



    public static function rules($id = 0){


        return [

            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('categories', 'name')->ignore($id),
// بتقدر من هان تحط كلمات محجوزة ممنوع حد يستخدمها في خانة الاسم مثل laravel او عن طريق انشاء php artisan make:rule جديد من التريمينال

                // function($attribute , $value , $fails){
                //     if (strtolower($value) == 'laravel'){
                //         $fails('This name is forbidden');
                //     }
                // }
                    'filter:php,laravel'
                // new Fillter(['laravel','php','html','css']),
            ],
            'parent_id' => [
                'nullable',
                'int',
                'exists:categories,id'
            ],
            'image' => [
                'image',
                'max:1048576',
                'dimensions:min_width=100,min:height=100'
            ],

            'status' => 'required|in:active,archived'

        ];

    }

}
