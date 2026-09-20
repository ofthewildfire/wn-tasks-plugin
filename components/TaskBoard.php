<?php namespace Ofthewildfire\Tasks\Components;

use Cms\Classes\ComponentBase;
use Ofthewildfire\Tasks\Models\Task;
use Winter\User\Facades\Auth;

class TaskBoard extends ComponentBase
{
    /**
     * Gets the details for the component
     */
    public function componentDetails()
    {
        return [
            'name'        => 'TaskBoard',
            'description' => 'A mini board of tasks ~'
        ];
    }

    /**
     * Returns the properties provided by the component
     */
    public function defineProperties()
    {
        return [
            'detailPage' => [
                'title'       => 'Detail page',
                'description' => 'The CMS page to link each task to.',
                'default'     => 'task-detail',
                'type'        => 'string',
            ],
        ];
    }


    public function onRun()
    {
        $this->page['detailPage'] = $this->property('detailPage');
        $logged_in_user = Auth::getUser();
        $tasks = Task::where('user_id', $logged_in_user->id)->orderBy('due_date')->get();
        $this->page['columns'] = Task::STATUSES;
        $this->page['tasksByStatus'] = $tasks->groupBy('status');
    }
}
