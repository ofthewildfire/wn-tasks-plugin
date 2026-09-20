<?php

namespace Ofthewildfire\Tasks;

use Backend\Facades\Backend;
use Backend\Models\UserRole;
use Ofthewildfire\Tasks\Components\TaskBoard;
use System\Classes\PluginBase;

/**
 * Tasks Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => 'ofthewildfire.tasks::lang.plugin.name',
            'description' => 'ofthewildfire.tasks::lang.plugin.description',
            'author'      => 'Ofthewildfire',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register(): void
    {

    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot(): void
    {


    }

    /**
     * Registers any frontend components implemented in this plugin.
     */
    public function registerComponents(): array
    {
        return [
            \Ofthewildfire\Tasks\Components\TaskBoard::class => 'taskBoard',
            \Ofthewildfire\Tasks\Components\TaskDetail::class => 'taskDetail',
        ];
    }

    /**
     * Registers any backend permissions used by this plugin.
     */
    public function registerPermissions(): array
    {
        return [
            'ofthewildfire.tasks.some_permission' => [
                'tab' => 'ofthewildfire.tasks::lang.plugin.name',
                'label' => 'ofthewildfire.tasks::lang.permissions.all',
                'roles' => [UserRole::CODE_DEVELOPER, UserRole::CODE_PUBLISHER],
            ],
        ];
    }

    /**
     * Registers backend navigation items for this plugin.
     */
    public function registerNavigation(): array
    {
//        return []; // Remove this line to activate

        return [
            'tasks' => [
                'label'       => 'ofthewildfire.tasks::lang.plugin.name',
                'url'         => Backend::url('ofthewildfire/tasks/tasks'),
                'icon'        => 'icon-leaf',
                'permissions' => ['ofthewildfire.tasks.*'],
                'order'       => 500,
            ],
        ];
    }
}
