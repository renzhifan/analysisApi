<?php

namespace App\Http\Controllers\Api;

use App\Models\UserCredit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    public function getUserCredit()
    {
        try{
            return UserCredit::userCredit();
        }catch (\Exception $e){
            \Log::error($e->getMessage());
        }
    }
}
