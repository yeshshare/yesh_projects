<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Employee
 *
 * @property $id
 * @property $company_id
 * @property $name
 * @property $email
 * @property $telefone
 * @property $vinculo
 * @property $endereco
 * @property $email_verified_at
 * @property $password
 * @property $remember_token
 * @property $employees_office_id
 * @property $employees_bu_id
 * @property $img
 * @property $created_at
 * @property $updated_at
 *
 * @property Company $company
 * @property EmployeesBu $employeesBu
 * @property EmployeesOffice $employeesOffice
 * @property ManagerBu[] $managerBus
 * @property ProjectEmployee[] $projectEmployees
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Employee extends Model
{
    use HasFactory;

    static $rules = [
		'company_id' => 'required',
		'employees_office_id' => 'required',
		'employees_bu_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id','name','email','telefone','vinculo','endereco','employees_office_id','employees_bu_id','img','adm'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company()
    {
        return $this->hasOne('App\Models\Company', 'id', 'company_id');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employeesBu()
    {
        return $this->hasOne('App\Models\EmployeesBu', 'id', 'employees_bu_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employeesOffice()
    {
        return $this->hasOne('App\Models\EmployeesOffice', 'id', 'employees_office_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function managerBus()
    {
        return $this->hasMany('App\Models\ManagerBu', 'employees_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projectEmployees()
    {
        return $this->hasMany('App\Models\ProjectEmployee', 'employees_id', 'id');
    }
    

}
