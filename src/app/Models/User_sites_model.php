<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CommonTrait;

class User_sites_model extends Model
{
    use HasFactory;

    use SoftDeletes;

    public $timestamps = true;  // will not take default column created_at and updated_at

    protected $table = 'user_sites';

    protected $primaryKey = 'user_site_id';   //make default primary key

    protected $guarded = []; //allow  fill all data in table  

    use CommonTrait; // Attach the Sluggable trait to the model

    protected static function booted()
    {
        // static::addGlobalScope(new GlobeScope); 
		static::saving(function ($model) {
	            // Remember that $model here is an instance of Article
	            // $model->created_by = $model->company_detail("");
        });
	}
}
