<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo',
        'email',
        'name',
    ];

    //   START RELATION
    public  function company(){
        return $this->hasMany(Employee::class);
    }
    //   END RELATION

}
