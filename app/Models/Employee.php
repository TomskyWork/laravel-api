<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = "employees";

    //specify which columns will be fillable by the model 
    protected $fillable = ["name", "email", "phone_no", "gender", "age"];

    // when deleted timestamp column from the migration file need this 
    // otherwise laravel is looking for default fields
    public $timestamps = false;
}
