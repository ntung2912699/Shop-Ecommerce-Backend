<?php

namespace App\Repositories\UsersRepository;

use App\Repositories\BaseRepository;

class UsersProfileRepository extends BaseRepository implements UsersProfileRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\UsersProfile::class;
    }

    public function get_user_profile($user_id){
        $profile = $this->model->where('users_id', '=' , $user_id)->get();
        return $profile;
    }
}
