<?php

namespace App\Modules\Company\Models;

use App\Modules\Employee\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Company extends Model
{
    use HasFactory,HasApiTokens;

    protected $table = 'companies';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'address',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
