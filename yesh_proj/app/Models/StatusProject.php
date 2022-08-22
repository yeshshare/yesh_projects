<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StatusProject
 *
 * @property $id
 * @property $company_id
 * @property $description
 * @property $employee_id
 * @property $project_id
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Company $company
 * @property Employee $employee
 * @property Project $project
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class StatusProject extends Model
{
    
    static $rules = [
		'company_id' => 'required',
		'employee_id' => 'required',
		'project_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id','description','employee_id','project_id','status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company()
    {
        return $this->hasOne('App\Models\Company', 'id', 'company_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employee()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employee_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project()
    {
        return $this->hasOne('App\Models\Project', 'id', 'project_id');
    }
    

}
