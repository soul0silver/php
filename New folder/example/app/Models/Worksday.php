<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worksday extends Model
{
    use  HasFactory;

    public $fillable=[
          'eid',
          'absent',
          'year'
          ];


}
