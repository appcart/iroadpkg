<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies_model extends Model
{
    use HasFactory;

    public $timestamps = true;  // will not take default column created_at and updated_at

   
    protected $table = 'companies'; 
    
    protected $primaryKey = 'company_id';   //make default primary key
    
    protected $guarded = []; //allow  fill all data in table  
}
