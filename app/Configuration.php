<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Configuration extends Authenticatable
{
    const NAME = 'Configuration';

    protected $table = "configuration";

    public $timestamps = true;

}
