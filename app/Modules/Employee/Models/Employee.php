<?php

namespace App\Modules\Employee\Models;

use App\Modules\Company\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Employee extends Model
{
    use HasFactory,HasApiTokens;


    protected $fillable = [
        'name',
        'email',
        'position',
        'company_id',
    ];
    public function companie()
    {
        return $this->belongsTo(Company::class);
    }
}
