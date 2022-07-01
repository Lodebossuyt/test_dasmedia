<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function vacatures(){
        return $this->hasMany(Vacature::class, 'company_id');
    }
}
