<?php

namespace Ofthewildfire\Tasks\Models;

use Backend\Facades\BackendAuth;
use Winter\Storm\Database\Model;
use Winter\Storm\Database\Relations\BelongsTo;
use Winter\User\Models\User;

/**
 * Task Model
 */
class Task extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'ofthewildfire_tasks_tasks';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['id', 'created_by'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'due_date'
    ];

    public const STATUSES = [
        'todo'        => 'To Do',
        'in_progress' => 'In Progress',
        'done'        => 'Done',
    ];


//    Task will have lots of comments from other isers

    public function comments()
    {
        return $this->hasMany(TaskComment::class);
    }


    public static function boot()
    {
        parent::boot();

        static::creating(function ($task) {
            if (!$task->created_by && $user = BackendAuth::getUser()) {
                $task->created_by = $user->id;
            }
        });
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function creator(): BelongsTo
    {
        return $this->belongsTo(\Backend\Models\User::class, 'created_by');
    }
    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $hasOneThrough = [];
    public $hasManyThrough = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
