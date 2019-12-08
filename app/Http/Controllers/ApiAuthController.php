<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Member;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Auth;

use App\Helpers\Helper;

class ApiAuthController extends Controller
{
    // public function register(Request $request) {
    //     $validated_data = $request->validate([
    //         'username' => 'required',
    //         'password' => 'required|confirmed',
    //     ]);

    //     $validated_data['password'] = bcrypt($request->password);

    //     $member = Member::create($validated_data);
    //     $accessToken = $member->createToken('authToken');

    //     return redirect('profiling', [
    //         'member' => $member,
    //         'access_token' => $accessToken
    //     ]);
    // }

    public function login(Request $request) {
        $login_data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        if (!auth()->attempt($login_data)) {
            return response(['message' => 'Invalid credentials']);
        }

        $member = new Member;
        $accessToken = $member->createToken('authToken')->accessToken;
        
        return response(['access_token' => $accessToken]);
    }
}
