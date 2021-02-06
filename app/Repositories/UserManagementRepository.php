<?php

namespace App\Repositories;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str; 
use App\Service;
use App\User;
use Illuminate\Support\Arr;

class UserManagementRepository extends Controller
{
    public function registerUser($request)
    {

        $checkCount = User::where('email', '=', $request['email'])
                        ->get()
                        ->count();
        if($checkCount > 0)
        {
            return response()->json(['User Already Exists'], 400);
        }

        $input = $request;
        $date = new Carbon( $request['birthDate']);  
        $year = (int)$date->year;
        $input['age'] = (int)date("Y") - $year;
        $user = User::create($input);


        return response()->json(['SUCCESS'],200);

    }
}