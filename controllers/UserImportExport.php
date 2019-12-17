<?php namespace VojtaSvoboda\UserImportExport\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use VojtaSvoboda\UserImportExport\Models\Settings as SettingsModel;

class UserImportExport extends Controller
{
    public $implement = [
        'Backend.Behaviors.ImportExportController'
    ];

    public $importExportConfig = 'config_import_export.yaml';

    public function __construct()
    {
        $custom_config = SettingsModel::get('controller_config_override', null);
        if($custom_config){
            $this->importExportConfig = $custom_config;
        }

        parent::__construct();

        BackendMenu::setContext('RainLab.User', 'user', $this->action);
    }

}
