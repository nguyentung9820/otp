<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Transactions extends Authenticatable
{
    const NAME = 'Lich su giao dich';

    protected $table = "transactions";

    public $timestamps = true;

}
