<?php namespace VojtaSvoboda\UserImportExport\Models;

use Backend\Models\ExportModel;
use RainLab\User\Models\User;

class UserExportModel extends ExportModel
{
    public function exportData($columns, $sessionKey = null)
    {
        $users = User::all();
        $users->each(function($user) use ($columns) {
            $user->addVisible($columns);
        });

        return $users->toArray();
    }
}
