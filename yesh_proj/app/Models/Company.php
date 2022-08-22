<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Company
 *
 * @property $id
 * @property $razao
 * @property $fantasia
 * @property $cnpj
 * @property $contato
 * @property $email
 * @property $created_at
 * @property $updated_at
 * @property $img
 *
 * @property Employee[] $employees
 * @property EmployeesBu[] $employeesBus
 * @property EmployeesOffice[] $employeesOffices
 * @property Project[] $projects
 * @property User[] $users
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Company extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['razao','fantasia','cnpj','contato','email','img'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees()
    {
        return $this->hasMany('App\Models\Employee', 'company_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employeesBus()
    {
        return $this->hasMany('App\Models\EmployeesBu', 'company_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employeesOffices()
    {
        return $this->hasMany('App\Models\EmployeesOffice', 'company_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany('App\Models\Project', 'company_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'company_id', 'id');
    }
    

}
