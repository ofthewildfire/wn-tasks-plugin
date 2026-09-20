<?php namespace Ofthewildfire\Tasks\Components;

use Cms\Classes\ComponentBase;
use Ofthewildfire\Tasks\Models\Task;
use Winter\User\Facades\Auth;

class TaskDetail extends ComponentBase
{
    /**
     * Gets the details for the component
     */
    public function componentDetails()
    {
        return [
            'name'        => 'TaskDetail',
            'description' => 'Task detail component which shows a comment section and the task.'
        ];
    }

    /**
     * Returns the properties provided by the component
     */
    public function defineProperties()
    {
        return [
            'taskId' => [
                'title'       => 'Task ID',
                'description' => 'Looks up the task using this route parameter.',
                'default'     => '{{ :id }}',
                'type'        => 'string',
            ],
            'boardPage' => [
                'title'   => 'Board page',
                'description' => 'The CMS page to link back to.',
                'default' => 'tasks',
                'type'    => 'string',
            ],
        ];
    }


    public function onRun()
    {
        $this->page['boardPage'] = $this->property('boardPage');
        $user = Auth::getUser();

        $this->page['columns'] = Task::STATUSES;
        $this->page['task'] = Task::with(['comments', 'comments.author'])->where('user_id', $user->id)
            ->find($this->property('taskId'));
    }

    public function onUpdateStatus()
    {

        $this->page['boardPage'] = $this->property('boardPage');

        $user = Auth::getUser();
        $task = Task::where('user_id', $user->id)->findOrFail($this->property('taskId'));

        $status = post('status');
        if (!array_key_exists($status, Task::STATUSES)) {
            throw new \ApplicationException('Invalid task status.');
        }

        $task->status = $status;
        $task->save();

        $this->page['columns'] = Task::STATUSES;
        $this->page['task'] = $task;
    }


    public function onAddComment()
    {

//        for some wild reason it registers the back button as the task itself not board so this will keep it locked to board
        $this->page['boardPage'] = $this->property('boardPage');

        $user = Auth::getUser();
        $task = Task::where('user_id', $user->id)->findOrFail($this->property('taskId'));

        $body = trim((string) post('body'));
        if ($body === '') {
            throw new \ApplicationException('Please enter a comment before submitting.');
        }

        $task->comments()->create([
            'body'    => $body,
            'user_id' => $user->id,
        ]);

        $this->page['columns'] = Task::STATUSES;
        $this->page['task'] = $task->fresh(['comments', 'comments.author']);
    }
}
