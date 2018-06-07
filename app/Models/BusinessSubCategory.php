<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth,File;

class BusinessSubCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_category_id','name'
    ];


    /**
     *
     */
    protected static function getSubCategoryByCategoryId($categoryId){

    	return static::where('business_category_id', $categoryId)->get();
    }
}
