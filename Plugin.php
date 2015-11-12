<?php namespace VojtaSvoboda\UserImportExport;

use Backend;
use Config;
use Event;
use Log;
use System\Classes\PluginBase;
use RainLab\User\Controllers\Users;

/**
 * User Import Export Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'vojtasvoboda.userimportexport::lang.plugin.name',
            'description' => 'vojtasvoboda.userimportexport::lang.plugin.description',
            'author'      => 'Vojta Svoboda',
            'icon'        => 'icon-sign-in',
        ];
    }

    public function registerPermissions()
    {
        return [
            'vojtasvoboda.userimportexport.*' => [
                'tab'   => 'vojtasvoboda.userimportexport::lang.permissions.tab',
                'label' => 'vojtasvoboda.userimportexport::lang.permissions.all.label'
            ]
        ];
    }

    public function boot()
    {
        Event::listen('backend.menu.extendItems', function($manager)
        {
            $manager->addSideMenuItems('RainLab.User', 'user', [
                'users' => [
                    'label'       => 'rainlab.user::lang.users.menu_label',
                    'url'         => Backend::url('rainlab/user/users'),
                    'icon'        => 'icon-user',
                    'permissions' => ['rainlab.users.*'],
                    'order'       => 100,
                ],
                'import' => [
                    'label'       => 'Import',
                    'url'         => Backend::url('vojtasvoboda/userimportexport/userimportexport/import'),
                    'icon'        => 'icon-sign-in',
                    'permissions' => ['vojtasvoboda.userimportexport.import'],
                    'order'       => 200,
                ],
                'export' => [
                    'label'       => 'Export',
                    'url'         => Backend::url('vojtasvoboda/userimportexport/userimportexport/export'),
                    'icon'        => 'icon-sign-out',
                    'permissions' => ['vojtasvoboda.userimportexport.export'],
                    'order'       => 300,
                ],
            ]);
        });
    }
}
