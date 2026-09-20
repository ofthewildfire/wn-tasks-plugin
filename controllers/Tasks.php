<?php

namespace Ofthewildfire\Tasks\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;

/**
 * Tasks Backend Controller
 */
class Tasks extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    /**
     * @var array Permissions required to view this page.
     */
    protected $requiredPermissions = [
        'ofthewildfire.tasks.tasks.manage_all',
    ];
}
