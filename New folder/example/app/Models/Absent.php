<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
    use  HasFactory;

    public $fillable=[
          'eid',
          'from_date',
          'to_date',
          'from_hour',
          'to_hour',
          'type'
          ];


}
