<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Member;
use Laravel\Passport\Token;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $login_data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $ldate = date('F d, Y l');

        if (!auth()->attempt($login_data)) {
            return view('index', ['message' => 'Invalid credentials. You typed in a wrong username/password.', 'ldate' => $ldate]);
        }

        $user = auth()->user();
        
        if ($user->classification_id == 3) {
            auth()->logout();
            return view('index', ['message' => 'Members have no login privileges. Must login as admin or staff account.', 'ldate' => $ldate]);
        }


        $member = new Member;
        $accessToken = $member->createToken('authToken')->accessToken;

        session(['access_token' => $accessToken]);

        return redirect('dashboard');
    }

    public function logout() {
        // dd(Auth::user()->id);
        // $member = Member::findOrFail(1);
        // $tokens = $member->tokens;
        // foreach ($tokens as $token) {
        //     if ($token->user_id == $member->id) {
        //         $token->revoke();
        //     }
        // }
        Auth::logout();
        session()->forget('access_token');
        return redirect('login');
    }

    public function register(Request $request) {
        $validated_data = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'branch_id' => 'required',
            'address' => 'required',
            'birthdate' => 'required',
            'contact' => 'required',
            'status' => 'required',
            'classification_id' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed',
        ]);

        $validated_data['password'] = bcrypt($request->password);

        if ($request->imgbase64 != "") {
            $this->uploadPic('/images/pics/', $request->username, $request->imgbase64);
        }

        if ($request->sigbase64 != "") {
            $this->uploadPic('/images/signatures/', $request->username, $request->sigbase64);
        }

        $member = Member::create($validated_data);
        // $accessToken = $member->createToken('authToken');
  
        return redirect('profiling');
    }

    public function uploadPic($path, $fn, $b64) {
        $path = public_path() . $path . $fn . ".png";

        $img = substr($b64, strpos($b64, ",") + 1);
        $imagedata = base64_decode($img);
        file_put_contents($path, $imagedata); 
    }

    public function getScan() {
        $user = auth()->user();

        return response(['qr_code' => $user->access_token]);
    }
}
