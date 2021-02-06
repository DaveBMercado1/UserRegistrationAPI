<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Validator;
use App\Repositories\UserManagementRepository;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{

    protected $userRepo;

    public function __construct(UserManagementRepository $userRepo)
    {
        $this->repo = $userRepo;
    }

    public function UserProcess(Request $request)
    {

        $Validation = $this->validate($request, [
            'fullName' => 'Required',
            'email' => 'Required||Email',
            'phoneNum' => 'Required||starts_with:09||numeric||min:11',
            'birthDate' => 'Required||date_format:Y-m-d',
            'gender' => 'Required',
        ]);

        $registerResponse = $this->repo->registerUser($request->all());
        return $registerResponse;


    }
}
