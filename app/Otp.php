<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Otp extends Authenticatable
{
    const NAME = 'otp';

    protected $table = "otp";

    public $timestamps = true;

}
