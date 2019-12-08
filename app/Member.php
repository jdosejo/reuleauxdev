<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Member extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'id',
        'branch_id',
        'classification_id',
        'firstname',
        'lastname',
        'middlename',
        'age',
        'birthdate',
        'address',
        'status',
        'contact',
        'picture',
        'password',
        'username',
        'signature'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function findForPassport($username) {
        return $this->where('username', $username)->first();
    }
}
