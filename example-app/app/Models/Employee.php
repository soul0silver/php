<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use  HasFactory;

    public $fillable=[
          'name',
          'depart',
          'quantity'
          ];


}
