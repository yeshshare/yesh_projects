<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 *
 * @property $id
 * @property $company_id
 * @property $title
 * @property $description
 * @property $brief
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Company $company
 * @property ProjectEmployee[] $projectEmployees
 * @property Session[] $sessions
 * @property Task1[] $task1s
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Project extends Model
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
    protected $fillable = ['company_id','title','description','brief','status'];


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
    public function projectEmployees()
    {
        return $this->hasMany('App\Models\ProjectEmployee', 'project_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions()
    {
        return $this->hasMany('App\Models\Session', 'project_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function task1s()
    {
        return $this->hasMany('App\Models\Task1', 'projetos_id', 'id');
    }
    

}
