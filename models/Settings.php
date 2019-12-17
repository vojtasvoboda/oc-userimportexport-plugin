<?php namespace VojtaSvoboda\UserImportExport\Models;

use Model;

class Settings extends Model
{
    public $implement = [
        \System\Behaviors\SettingsModel::class
    ];
    public $settingsCode = 'vojtasvoboda_userimportexport_settings';
    public $settingsFields = 'fields.yml';
}