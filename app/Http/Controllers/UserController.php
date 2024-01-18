<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rr)
    {
        $this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rr;
    }


    /**
     * @OA\Get(
     * tags={"User Management"},
     * path= "/pds-backend/api/users",
     * operationId="getUsers",
     * summary="User List",
     * description="User List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getUsers(Request $request)
    {
        try {
            $user = User::paginate(8);
            return response()->json([
                'status' => 'success',
                'userList' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }


    public function search(Request $request)
    {
        try {
            $perPage = isset($request->perPage) ? intval($request->perPage) : 8;
            $data =  User::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('role_id', 'like', '%' . $request->search . '%')
                ->orderBy('id', 'desc')
                ->paginate($perPage);

            return response()->json([
                'status'  => true,
                'message' => "user list get successfully",
                'errors'  => null,
                'data'    => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }

    /**
     * @OA\Post(
     * tags={"User Management"},
     * path="/pds-backend/api/addUser",
     * operationId="addUser",
     * summary="Add New User",
     * description="Add New User",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"name","email", "password", "status", "role_id","phone"},
     *               @OA\Property(property="name", type="text"),
     *               @OA\Property(property="email", type="text"),
     *               @OA\Property(property="phone", type="text"),
     *               @OA\Property(property="password", type="password"),
     *               @OA\Property(property="status", type="text"),
     *               @OA\Property(property="role_id", type="text")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Added User Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */



    public function addUser(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                //'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|string|phone|max:100',
                'password' => 'required|string|min:6',
                'role_id' => 'required|integer',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email ?? '',
                'phone' => $request->phone,
                'role_id' => $request->role_id,
                'status' => $request->status,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'status'  => true,
                'message' => "user created successfully",
                'errors'  => null,
                'data'    => $user,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Get(
     * tags={"User Management"},
     * path="/pds-backend/api/users/{id}",
     * operationId="userDetail",
     * summary="User Detail",
     * description="",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function userDetail(Request $request)
    {
        try {
            $userDetail = User::leftJoin('employees', 'users.id', '=', 'employees.user_id')->select(
                'users.*',
                'employees.id as employee_id',
            )->findOrFail($request->id);
            return response()->json([
                'status' => 'success',
                'userDetail' => $userDetail,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }


    /**
     * @OA\Put(
     * tags={"User Management"},
     * path="/pds-backend/api/users/{id}",
     * operationId="updateUser",
     * summary="Update User",
     * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     * @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="name", type="string", example="Shakiur Rahman"),
     *              @OA\Property(property="email", type="string", example="shakiur.cse@gmail.com"),
     *              @OA\Property(property="password", type="string", example="Ghit@123"),
     *              @OA\Property(property="role_id", type="integer", example=1),
     *              @OA\Property(property="status", type="integer", example=1),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="User Update Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */


    public function updateUser(Request $request, $id)
    {

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                //'email' => 'required|unique:users,email,'.$id,
                'phone' => 'required|max:11|unique:users,phone,' . $id,
                'role_id' => 'required',
                'status' => 'required'
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email ?? '';
            $user->phone = $request->phone;
            $user->role_id = $request->role_id;
            $user->status = $request->status;

            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            $employee = Employee::where('employees.user_id', '=', $id)->first();
            $employee->name = $request->name;
            $employee->email = $request->email ?? '';
            $employee->mobile_number = $request->phone;
            // $employee->status = $request->status;

            // return $employee;
            $employee->save();
            return response()->json([
                'status'  => true,
                'message' => "user updated successfully",
                'errors'  => null,
                'data'    => $request->all(),
                'employee' => $employee
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    /**
     * @OA\Delete(
     *     path="/pds-backend/api/users/{id}",
     *     tags={"User Management"},
     *     summary="Delete User",
     *     description="Delete User With Valid ID",
     *     operationId="deleteUser",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Delete Employee" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function deleteUser($id)
    {
        try {
            $user =  User::findOrFail($id);
            $user->delete();

            return response()->json([
                'status'  => true,
                'message' => "user deleted successfully",
                'errors'  => null,
                'data'    => $user,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

/**
 * @OA\Patch(
 *     path="/pds-backend/api/activeUser/{id}",
 *     tags={"User Management"},
 *     summary="Activate User",
 *     description="Activate a specific User with a valid ID",
 *     operationId="activeUser",
 *     @OA\Parameter(
 *         name="id",
 *         description="ID of the User",
 *         example=1,
 *         required=true,
 *         in="path",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response=200, description="Successfully activated User"),
 *     @OA\Response(response=400, description="Bad Request"),
 *     @OA\Response(response=404, description="Resource Not Found"),
 *     security={{"bearer_token":{}}}
 * )
 */

 public function activeUser($id)
 {
     try {
         $user = User::find($id);
 
         if (!is_null($user)) {
             User::where('id', '=', $id)->update(['status' => 1]);
 
             return response()->json([
                 'status'  => true,
                 'message' => "Activated User Successfully",
                 'errors'  => null,
                 'data'    => $user,
             ], 200);
         } else {
             return $this->responseRepository->ResponseSuccess(null, 'User ID is not valid!');
         }
     } catch (\Exception $e) {
         return $this->responseRepository->ResponseError(
             null,
             $e->getMessage(),
             Response::HTTP_INTERNAL_SERVER_ERROR
         );
     }
 }

 /**
 * @OA\Patch(
 *     path="/pds-backend/api/inactiveUser/{id}",
 *     tags={"User Management"},
 *     summary="Activate User",
 *     description="Activate a specific User with a valid ID",
 *     operationId="inactiveUser",
 *     @OA\Parameter(
 *         name="id",
 *         description="ID of the User",
 *         example=1,
 *         required=true,
 *         in="path",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response=200, description="Successfully activated User"),
 *     @OA\Response(response=400, description="Bad Request"),
 *     @OA\Response(response=404, description="Resource Not Found"),
 *     security={{"bearer_token":{}}}
 * )
 */

 public function inactiveUser($id)
 {
     try {
         $user = User::find($id);
 
         if (!is_null($user)) {
             User::where('id', '=', $id)->update(['status' => 0]);
 
             return response()->json([
                 'status'  => true,
                 'message' => "Activated User Successfully",
                 'errors'  => null,
                 'data'    => $user,
             ], 200);
         } else {
             return $this->responseRepository->ResponseSuccess(null, 'User ID is not valid!');
         }
     } catch (\Exception $e) {
         return $this->responseRepository->ResponseError(
             null,
             $e->getMessage(),
             Response::HTTP_INTERNAL_SERVER_ERROR
         );
     }
 }
 }
