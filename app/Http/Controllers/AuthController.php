<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Employee;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rr)
    {
        //$this->middleware('auth:api', ['except' => ['login','register']]);
        $this->responseRepository = $rr;
    }


    /**
     * @OA\Post(
     * path="/pds-backend/api/auth/login",
     * operationId="Login",
     * tags={"Authentication"},
     * summary="User Login",
     * description="User Login here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"phone", "password"},
     *               @OA\Property(property="phone", type="text", example=""),
     *               @OA\Property(property="password", type="password", example="")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Login Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Login Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function login(Request $request)
    {
        try {
            $request->validate([
                // 'email' => 'required|string|email',
                'phone' => 'required|numeric',
                'password' => 'required|string'
            ]);
            //$credentials = $request->only('email', 'password');
            $credentials = $request->only('phone', 'password');

            $token = Auth::attempt($credentials);
            if (!$token) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid phone or Password!',
                ], 401);
            }

            $user = Auth::user();

            if ($token && $user->otp_verified == 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Not verified.',
                ], 402);
            }

            if ($token && $user->status == 0) {
                return response()->json([
                    'status' => 'inactive',
                    'message' => 'Not active yet',
                ], 400);
            }

            $menu = [];

            if ($user->role_id == 1) {
                $menu = [
                    [
                        'title' => 'Dashboard',
                        'slug' => '/dashboard',
                        'icon' => 'fa fa-tachometer',
                    ],
                    [
                        'title' => 'User List',
                        'slug' => '/users',
                        'icon' => 'fa fa-users nav-icon',
                    ],
                    [
                        'title' => 'Employee List',
                        'slug' => '/employees',
                        'icon' => 'fa fa-users nav-icon',
                    ],
                    [
                        'title' => 'Transfer List',
                        'slug' => '/transfer',
                        'icon' => 'fa fa-exchange nav-icon',
                    ],
                    [
                        'title' => 'Promotion',
                        'slug' => '/promotion-list',
                        'icon' => 'fa fa-trophy nav-icon',
                    ],
                    [
                        'title' => 'Training List',
                        'slug' => '/training-list',
                        'icon' => 'fa fa-file nav-icon',
                    ],
                    [
                        'title' => 'SMS Send',
                        'slug' => '/sms-send',
                        'icon' => 'fa fa-graduation-cap nav-icon',
                    ],
                    [
                        'title' => 'Departments Setup',
                        'slug' => '/department-setup',
                        'icon' => 'fa fa-graduation-cap nav-icon',
                    ],
                    [
                        'title' => 'Training Setup',
                        'slug' => '/training-setup',
                        'icon' => 'fa fa-graduation-cap nav-icon',
                    ],
                    [
                        'title' => 'Office Setup',
                        'slug' => '/office-setup',
                        'icon' => 'fa fa-graduation-cap nav-icon',
                    ],

                    [
                        'title' => 'ACR',
                        'slug' => '/acr',
                        'icon' => 'fa fa-newspaper-o nav-icon',
                    ],
                    [
                        'title' => 'Report',
                        'slug' => '/report',
                        'icon' => 'fa fa-file nav-icon',
                    ],
                    [
                        'title' => 'Leave',
                        'slug' => '/leave',
                        'icon' => 'fa fa-snowflake-o nav-icon',
                    ],
                ];
            }
            if ($user->role_id == 2) {
                $menu = [
                    [
                        'title' => 'Dashboard',
                        'slug' => '/dashboard',
                        'icon' => 'fa fa-tachometer',
                    ],
                    [
                        'title' => 'Profile',
                        'slug' => '/profile',
                        'icon' => 'fa fa-tachometer',
                    ],
                    [
                        'title' => 'Transfer',
                        'slug' => '/transfer',
                        'icon' => 'fa fa-users nav-icon',
                    ],
                    [
                        'title' => 'Training',
                        'slug' => '/training',
                        'icon' => 'fa fa-graduation-cap nav-icon',
                    ],
                    [
                        'title' => 'Promotion',
                        'slug' => '/promotion',
                        'icon' => 'fa fa-trophy nav-icon',
                    ],
                    [
                        'title' => 'Leave',
                        'slug' => '/leave',
                        'icon' => 'fa fa-file nav-icon',
                    ],
                    [
                        'title' => 'ACR',
                        'slug' => '/acr',
                        'icon' => 'fa fa-newspaper-o nav-icon',
                    ],
                    [
                        'title' => 'Report',
                        'slug' => '/report',
                        'icon' => 'fa fa-newspaper-o nav-icon',
                    ]
                ];
            }

            $user['menu'] = $menu;
            return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }

    /**
     * @OA\Post(
     * path="/pds-backend/api/auth/register",
     * operationId="Register",
     * tags={"Authentication"},
     * summary="User Register",
     * description="User Register here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"name","email", "password", "password_confirmation", "phone"},
     *               @OA\Property(property="name", type="text"),
     *               @OA\Property(property="email", type="text"),
     *               @OA\Property(property="phone", type="text"),
     *               @OA\Property(property="status", type="text"),
     *               @OA\Property(property="password", type="password"),
     *               @OA\Property(property="password_confirmation", type="password"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Register Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Register Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                //'email' => 'required|string|email|max:255|unique:users',
                //'phone' => 'required|numeric|unique:users',
                'phone' => 'required|numeric|unique:users',
                'password' => 'required|string|min:6',
            ]);

            if (User::where('phone', $request->phone)->where('otp_verified', 1)->exists()) {
                return response()->json([
                    'status' => 'Fail',
                    'message' => 'User already registred',
                ], 500);
            }

            if (User::where('phone', $request->phone)->where('otp_verified', 0)->exists()) {
                $user = User::where('phone', $request->phone)->first();
                $otp = rand(123456, 999999);
                User::where('phone', $request->phone)->update([
                    'otp' => $otp,
                    'otp_expire_at' => Carbon::now()->addMinutes(2)
                ]);
                $url = env("MESSAGE_OTP_API", "http");
                $response = Http::withToken('token')->post($url, [
                    'mobileNumber' => $request->phone,
                    'message' => $otp,
                ])->throw(function (Response $response, RequestException $e) {
                })->json();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Otp have been updated.',
                    'user' => $user->id,
                ]);
            } else {
                $otp = rand(123456, 999999);
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'status' => 0,
                    'role_id' => 2,
                    'password' => Hash::make($request->password),
                    'otp' => $otp,
                    'otp_expire_at' => Carbon::now()->addMinutes(2),
                    'otp_verified' => 0
                ]);

                $url = env("MESSAGE_OTP_API", "http");
                $response = Http::withToken('token')->post($url, [
                    'mobileNumber' => $request->phone,
                    'message' => $otp,
                ])->throw(function (Response $response, RequestException $e) {
                })->json();

                if ($response['status'] == "FAILED") {
                    User::where("id", $user->id)->delete();
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'userId' => $user->id,
                'otp' => $otp,
            ]);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Post(
     * path="/pds-backend/api/auth/otpVerify",
     * operationId="otpVerify",
     * tags={"Authentication"},
     * summary="User Otp Verification",
     * description="User Otp Verification",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"user_id","otp"},
     *               @OA\Property(property="user_id", type="text"),
     *               @OA\Property(property="otp", type="text"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Register Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Register Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function otpVerify(Request $request)
    {
        try {
            $userInfo = User::where("id", $request->user_id)->firstOrFail();

            if ($userInfo) {
                if ($userInfo->otp_verified == 1) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'User Already Verified.',
                    ]);
                }

                if ($userInfo->otp == $request->otp) {
                    if (Carbon::now()->isAfter($userInfo->otp_expire_at)) {
                        return response()->json([
                            'status' => 'expird',
                            'message' => 'OTP has a expired..',
                        ], 401);
                    }

                    User::where('id', $request->user_id)->update([
                        'otp_verified' => 1
                    ]);

                    Employee::create(['user_id' => $request->user_id, 'name' => $userInfo->name, 'mobile_number' => $userInfo->phone]);

                    return response()->json([
                        'status' => 'success',
                        'message' => 'OTP Verified Successfully.',
                        'user' => $userInfo,
                    ]);
                } else {
                    return response()->json([
                        'status' => 'unauthorized',
                        'message' => 'Invalid OTP.',
                    ], 400);
                }
            } else {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'User not found',
                ]);
            }

            return $this->responseRepository->ResponseSuccess(null, 'Fail to Verified Otp.');
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\POST(
     *     path="/pds-backend/api/auth/logout",
     *     tags={"Authentication"},
     *     summary="Logout",
     *     description="Logout",
     *     @OA\Response(response=200, description="Logout" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function logout(Request $request)
    {
        try {
            auth()->logout();
            return $this->responseRepository->ResponseSuccess(null, 'Logged out successfully !');
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
