<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    const NAME = 'Tài khoản';
    const ADMIN_TOKEN = '7ec905ca5ca77afd9d578f6643a09bd1';

    protected $table = "users";

    public $timestamps = false;

}
