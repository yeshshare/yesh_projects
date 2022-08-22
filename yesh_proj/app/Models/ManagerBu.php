<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ManagerBu
 *
 * @property $id
 * @property $employees_bu_id
 * @property $employees_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Employee $employee
 * @property EmployeesBu $employeesBu
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ManagerBu extends Model
{
    
    static $rules = [
		'employees_bu_id' => 'required',
		'employees_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['employees_bu_id','employees_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employee()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employees_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employeesBu()
    {
        return $this->hasOne('App\Models\EmployeesBu', 'id', 'employees_bu_id');
    }
    

}
