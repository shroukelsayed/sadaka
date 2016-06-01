<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function userInfo(){

        return $this->hasOne(UserInfo::class); 
    }

    public function charityAddress(){

        return $this->hasOne(CharityAddress::class); 
    } 

    public function compaign(){

        return $this->hasOne(Compaign::class); 
    } 

    public function personInfo(){

        return $this->hasOne(PersonInfo::class); 
    } 

    public function blood(){

        return $this->hasOne(Blood::class); 
    } 
}
