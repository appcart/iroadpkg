<?php
 
namespace Appcart\Iroad\app\Scopes;
use Session;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;

 
class GlobeScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {   
        $table=$model->getTable();
        $result = app('Appcart\Iroad\app\Http\Controllers\admin\Dashboard_controller')->logged_user();  
               
        // return $builder->where(
        //     [
        //         $table.'.company_id' => $result['user']->company_id
        //     ]
        // );
    }
}