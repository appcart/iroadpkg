<?php

namespace App\Models;
use App\Scopes\GlobeScope;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\CommonTrait;


class Activity_model extends Model
{
    use HasFactory;

    use SoftDeletes;

    public $timestamps = true;  // will not take default column created_at and updated_at

    protected $table = 'monitoring_activities';

    protected $primaryKey = 'activity_id';   //make default primary key

    protected $guarded = []; //allow  fill all data in table  

    use CommonTrait; // Attach the Sluggable trait to the model

    protected static function booted()
    {
        static::addGlobalScope(new GlobeScope); 
		static::saving(function ($model) {
	            // Remember that $model here is an instance of Article
	            $model->company_id = $model->company_detail("");
        });
	}
	
}
