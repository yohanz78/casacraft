<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use OpenApi\Annotations as OA;

/**
 * Class AuthController
 */
class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/user/register",
     *      tags={"user"},
     *      summary="Register new user & get token",
     *      operationId="register",
     *      @OA\Response(
     *          response=400,
     *          description="Invalid",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Success",
     *          @OA\JsonContent()
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Request body description",
     *          @OA\JsonContent(
     *              ref="#components/schemas/User",
     *              example={"name": "John Doe", "email": "johndoe@gmail.com", "password": "Ba88Jkt$", "password_confirmation": "Ba88Jkt$"}
     *          ),
     *      ),
     * )
     */
    public function register(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);
            if ($validator->fails()) {
                throw new HttpException($validator->messages()->first(), 400);
            }

            $req['password'] = Hash::make($req['password']);
            $req['remember_token'] = \Illuminate\Support\Str::random(10);
            $user = User::create($req->toArray());
            $token = $user->createToken('This is your token')->accessToken;

            return response()->json(
                array(
                    'name' => $req->name,
                    'email' => $req->get('email'),
                    'token' => $token
                ),
                200
            );
        } catch (\Exception $exception) {
            throw new HttpException("Invalid data: {$exception->getMessage()}", 400);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/user/login",
     *      tags={"user"},
     *      summary="Log in to existing user & get token",
     *      operationId="login",
     *      @OA\Response(
     *          response=400,
     *          description="Invalid",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent()
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Request body description",
     *          @OA\JsonContent(
     *              ref="#components/schemas/User",
     *              example={"email": "johndoe@gmail.com", "password": "Ba88Jkt$"}
     *          ),
     *      ),
     * )
     */
    public function login(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6',
            ]);
            if ($validator->fails()) {
                throw new HttpException($validator->messages()->first(), 400);
            }
            $user = User::where('email', $req->email)->first();

            if ($user) {
                if (Hash::check($req->password, $user->password)) {
                    $token = $user->createToken('This is your token')->accessToken;
                    return response()->json(
                        array(
                            'email' => $req->get('email'),
                            'token' => $token,
                            200
                        ),
                    );
                } else {
                    return response()->json(array('message' => 'Password mismatch'), 400);
                }
            } else {
                return response()->json(array('message' => 'User does not exist'), 400);
            }
        } catch (\Exception $exception) {
            throw new HttpException("Invalid data: {$exception->getMessage()}", 400);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/user/logout",
     *      tags={"user"},
     *      summary="Log out & self destroy token",
     *      operationId="logout",
     *      @OA\Response(
     *          response=400,
     *          description="Invalid",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          in="path",
     *          description="User Email",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *          )
     *      ),
     *      security={{"passport_token_ready":{},"passport":{}}}
     * )
     */
    public function logout(Request $req)
    {
        try {
            $token = $req->user()->token();
            $token->revoke();

            return response()->json(array('message' => 'Logged out successfully'), 200);
        } catch (\Exception $exception) {
            throw new HttpException("Invalid data: {$exception->getMessage()}", 400);
        }
    }
}

// Error 500 Fixed