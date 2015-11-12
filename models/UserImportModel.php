<?php namespace VojtaSvoboda\UserImportExport\Models;

use Backend\Models\ImportModel;
use RainLab\User\Models\User;

class UserImportModel extends ImportModel
{
    public $rules = [];

    public function importData($results, $sessionKey = null)
    {
        foreach ($results as $row => $data)
        {
            $username = $data['username'];
            $data += [
                'password' => $username,
                'password_confirmation' => $username,
                'is_activated' => true
            ];

            try {
                $user = new User();
                $user->fill($data);
                $user->save();

                // activate user
                $user->attemptActivation($user->activation_code);

                $this->logCreated();

            } catch (\Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }
        }
    }
}
