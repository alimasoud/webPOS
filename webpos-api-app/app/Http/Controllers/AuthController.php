<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            if (isset($request['username']) && isset($request['password'])) {

                $username = $request['username'];
                $password = $request['password'];

                $user = User::where([
                    ['username', '=', $username],
                ])->first();

                // dd(Hash::check($password, $user->password));
                if (!empty($user) && Hash::check($password, $user->password)) {

                    $token = $user->createToken('token-name', ['server:update'])->plainTextToken;

                    if ($token != null) {
                        $result['user'] = $user;
                        $response['success'] = true;
                        $response['status'] = 1;
                        $response['message'] = 'login successfully';
                        $response['result'] = $result;
                        $response['result']['token'] = $token;

                        return $response;
                    } else {
                        $response['success'] = false;
                        $response['status'] = 3;
                        $response['message'] = 'could not login';
                        return $response;
                    }
                } else {
                    $response['success'] = false;
                    $response['status'] = 7;
                    $response['message'] = 'Please check your creditional';
                    return $response;
                }
            } else {
                $response['success'] = false;
                $response['status'] = 0;
                $response['message'] = 'missing post data';
                $response['message_ar'] = 'missing post data';
                return $response;
            }
        } catch (\Throwable $exception) {

            $response['success'] = false;
            $response['status'] = 5;
            $response['message'] = 'Something went wrong';
            $response['result'] = $exception;
            return response($response);
        }
    }
}
