<?php namespace VojtaSvoboda\UserImportExport\Models;

use Backend\Models\ImportModel;
use Cms\Classes\MediaLibrary;
use System\Models\File;
use RainLab\Location\Models\State;
use RainLab\User\Models\User;

class UserImportModel extends ImportModel
{
    public $rules = [];

    public $imageStoragePath = '/users';

    public $imageVisibilityPublic = true;

    public function importData($results, $sessionKey = null)
    {
        foreach ($results as $row => $data)
        {
            $data += [
                'is_activated' => true,

                /* prepare for future usage */
                // 'state_id' => $this->getStateId($data['state']),
                // 'country_id' => 14
            ];

            if ( empty($data['username']) ) {
                $data['username'] = $data['email'];
            }

            if ( empty($data['password']) ) {
                $data['password'] = $data['username'];
            }

            if ( empty($data['password_confirmation']) ) {
                $data['password_confirmation'] = $data['password'];
            }

            try {
                $user = new User();
                $user->fill($data);

                // try to find avatar
                $avatar = $this->findAvatar($data['username']);
                if ( $avatar ) {
                    $user->avatar = $avatar;
                }

                // save user
                $user->save();

                // activate user
                $user->attemptActivation($user->activation_code);

                $this->logCreated();

            } catch (\Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }
        }
    }

    /**
     * @param $username
     *
     * @return string|null
     */
    private function findAvatar($username)
    {
        $library = MediaLibrary::instance();
        $files = $library->listFolderContents($this->imageStoragePath, 'title', 'image');

        foreach($files as $file) {
            $pathinfo = pathinfo($file->publicUrl);
            if ( $pathinfo['filename'] == $username ) {
                $file = new File();
                $file->is_public = $this->imageVisibilityPublic;
                $file->fromFile(base_path() . $pathinfo['dirname'] . '/' . $pathinfo['basename']);

                return $file;
            }
        }
    }

    /**
     * Get state by ident
     *
     * @param $stateIdent
     *
     * @return null
     */
    private function getStateId($stateIdent)
    {
        $state = State::where('code', $stateIdent)->first();
        if ( !$state ) return null;

        return $state->id;
    }

}
