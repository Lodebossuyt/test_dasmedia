<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacature extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function isPrime(){
        $n = 0;
        for($i = 2; $i < $this->id; $i++) {
            if($this->id % $i == 0){
                $n++;
                break;
            }
        }

        if ($n == 0){
            return true;
        } else {
            return false;
        }
    }

    public function isTenFold(){
        if(($this->id % 10 == 0) && ($this->id % 100 != 0)){
            return true;
        }else{
            return false;
        }
    }
}
