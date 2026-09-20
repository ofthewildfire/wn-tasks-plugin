<?php

namespace Ofthewildfire\Tasks\Models;

use Winter\Storm\Database\Model;
use Winter\Storm\Database\Relations\BelongsTo;
use Winter\User\Models\User;

/**
 * TaskComment Model
 */
class TaskComment extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'ofthewildfire_tasks_task_comments';

    /**
     * @var array Guarded fields
     */
//    lets do this one as fillable cause commentsd weird.
//    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['body', 'task_id', 'user_id'];


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
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function author(): BelongsTo
    {

//        this one is the author so its not the backend model logged in but the winter user model like rainlabs
        return $this->belongsTo(User::class, 'user_id');
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
