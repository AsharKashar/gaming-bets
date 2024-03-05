<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use JWTAuth;

class LoginAsUser extends RowAction
{
    public $name = 'Login as user';

    public function dialog()
    {
        $this->confirm('Are you sure to login as user?');
    }

    public function handle(Model $model)
    {
        if (!$userToken=JWTAuth::fromUser($model)) {
            return $this->response()->error('Login error');
        }

        return $this->response()->success('Success')->redirect('/?forceUserToken='.$userToken);
    }

}
