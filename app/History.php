<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class History extends Authenticatable
{
    const NAME = 'Lich su';

    protected $table = "history";

    public $timestamps = true;

}
