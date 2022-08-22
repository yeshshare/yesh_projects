<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Session
 *
 * @property $project_id
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property Project $project
 * @property Task1[] $task1s
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Session extends Model
{
    
    static $rules = [
		'project_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id','name','description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project()
    {
        return $this->hasOne('App\Models\Project', 'id', 'project_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function task1s()
    {
        return $this->hasMany('App\Models\Task1', 'session_id1', 'id');
    }
    

}
