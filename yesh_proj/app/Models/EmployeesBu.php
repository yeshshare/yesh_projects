<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeesBu
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $company_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Company $company
 * @property Employee[] $employees
 * @property ManagerBu[] $managerBus
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class EmployeesBu extends Model
{
    
    static $rules = [
		'company_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','company_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company()
    {
        return $this->hasOne('App\Models\Company', 'id', 'company_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees()
    {
        return $this->hasMany('App\Models\Employee', 'employees_bu_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function managerBus()
    {
        return $this->hasMany('App\Models\ManagerBu', 'employees_bu_id', 'id');
    }
    

}
