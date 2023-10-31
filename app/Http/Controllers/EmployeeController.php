<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Repositories\ResponseRepository;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use File;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    protected $responseRepository;
    public function __construct(ResponseRepository $rr)
    {
        // $this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rr;
    }

    /**
     * @OA\Get(
     * tags={"PDS User Employee [Users]"},
     * path= "/pds-backend/api/getEmployeesList",
     * operationId="getEmployeesList",
     * summary="Get All Employee List",
     * description="Get All Employee List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getEmployeesList(Request $request)
    {
        try {
            $employeeList = Employee::leftJoin('users', 'users.id', '=', 'employees.user_id')
                ->leftJoin('departments', 'departments.id', '=', 'employees.department')
                ->leftJoin('designations', 'designations.id', '=', 'employees.designation')
                ->select('employees.*', 'departments.dept_name as department_name', 'designations.designation_name as designation_name')
                ->orderBy('employees.id', 'desc');

            if (!empty($request->search)) {
                $employeeList = $employeeList->where('employees.name', 'like', '%' . $request->search . '%')
                    ->orWhere('employees.email', 'like', '%' . $request->search . '%')
                    ->orWhere('employees.mobile_number', 'like', '%' . $request->search . '%')
                    ->orWhere('departments.dept_name', 'like', '%' . $request->search . '%')
                    ->orWhere('designations.designation_name', 'like', '%' . $request->search . '%');
            }
            $employeeList = $employeeList->paginate(10);
            return response()->json([
                'status' => 'success',
                'data' => $employeeList,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }

    /**
     * @OA\Get(
     * tags={"PDS User Employee [Users]"},
     * path="/pds-backend/api/user/getprofile/{id}",
     * operationId="getprofile",
     * summary="Get User Employee List",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getprofile(Request $request, $id)
    {
        try {

            $getProfile = Employee::leftJoin('designations', 'designations.id', '=', 'employees.designation')
                ->leftJoin('departments', 'departments.id', '=', 'employees.department')
                ->select(
                    'employees.*',
                    'designations.id as designation_id',
                    'designations.designation_name as designation',
                    'departments.id as department_id',
                    'departments.dept_name as department'
                )
                ->where('employees.user_id', $id)->first();

            return response()->json([
                'status' => 'success',
                'data'   => $getProfile
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * @OA\Post(
     * tags={"PDS User Employee [Users]"},
     * path="/pds-backend/api/user/addProfile",
     * operationId="addProfile",
     * summary="Add User Employee",
     * description="Add User Employee",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *               @OA\Property(property="user_id", type="text"),
     *               @OA\Property(property="image", type="text"),
     *               @OA\Property(property="name", type="text"),
     *               @OA\Property(property="mobile_number", type="text"),
     *               @OA\Property(property="email", type="text"),
     *               @OA\Property(property="designation", type="text"),
     *               @OA\Property(property="present_addr_houseno", type="text"),
     *               @OA\Property(property="present_addr_roadno", type="text"),
     *               @OA\Property(property="present_addr_area", type="text"),
     *               @OA\Property(property="present_addr_upazila", type="text"),
     *               @OA\Property(property="present_addr_district", type="text"),
     *               @OA\Property(property="present_addr_postcode", type="text"),
     *               @OA\Property(property="permanent_addr_houseno", type="text"),
     *               @OA\Property(property="permanent_addr_roadno", type="text"),
     *               @OA\Property(property="permanent_addr_area", type="text"),
     *               @OA\Property(property="permanent_addr_upazila", type="text"),
     *               @OA\Property(property="permanent_addr_district", type="text"),
     *               @OA\Property(property="permanent_addr_postcode", type="text"),
     *               @OA\Property(property="department", type="text"),
     *               @OA\Property(property="job_location", type="text"),
     *               @OA\Property(property="joining_date", type="text"),
     *               @OA\Property(property="education_history", type="text"),
     *               @OA\Property(property="father_name", type="text"),
     *               @OA\Property(property="mother_name", type="text"),
     *               @OA\Property(property="spouse_name", type="text"),
     *               @OA\Property(property="number_of_cheild", type="text"),
     *               @OA\Property(property="emergency_name", type="text"),
     *               @OA\Property(property="emergency_relation", type="text"),
     *               @OA\Property(property="emergency_email", type="text"),
     *               @OA\Property(property="emergency_addr", type="text"),
     *               @OA\Property(property="emergency_distict", type="text"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="User Employee Added Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function addProfile(Request $request)
    {

        try {


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email ?? '',
                'phone' => $request->mobileNumber,
                'password' => Hash::make($request->password) ??  Hash::make('1234'),
                'otp_verified' => 1,
            ]);


            $addProfile = new Employee;
            $addProfile->user_id =  $user->id;
            // $addProfile->password = Hash::make($request->password) ??  Hash::make('1234');
            $addProfile->image = $request->image ?? '';
            $addProfile->name = $request->name ?? ''; //
            $addProfile->mobile_number = $request->mobileNumber ?? 0; //
            $addProfile->email = $request->email ?? ''; //
            $addProfile->designation = $request->designation;
            $addProfile->present_addr_houseno =  $request->present_addr_houseno ?? 0;
            $addProfile->present_addr_roadno = $request->present_addr_roadno ?? 0;
            $addProfile->present_addr_area = $request->present_addr_area ?? '';
            $addProfile->present_addr_upazila = $request->present_addr_upazila ?? '';
            $addProfile->present_addr_district = $request->present_addr_district ?? '';
            $addProfile->present_addr_postcode = $request->present_addr_postcode ?? 0;
            $addProfile->permanent_addr_houseno = $request->permanent_addr_houseno ?? 0;
            $addProfile->permanent_addr_roadno = $request->permanent_addr_roadno ?? 0;
            $addProfile->permanent_addr_area = $request->permanent_addr_area ?? '';
            $addProfile->permanent_addr_upazila = $request->permanent_addr_upazila ?? '';
            $addProfile->permanent_addr_district = $request->permanent_addr_district ?? '';
            $addProfile->permanent_addr_postcode = $request->permanent_addr_postcode ?? 0;
            $addProfile->department = $request->department ?? 0;
            $addProfile->job_location = $request->job_location ?? '';
            $addProfile->joining_date = $request->joining_date ?? '2000-02-22';
            $addProfile->education_history = $request->education_history ?? [];
            $addProfile->father_name = $request->father_name ?? '';
            $addProfile->mother_name = $request->mother_name ?? '';
            $addProfile->spouse_name = $request->spouse_name ?? '';
            $addProfile->number_of_child = $request->number_of_child ?? 0;
            $addProfile->emergency_name = $request->emergency_name ?? '';
            $addProfile->emergency_relation = $request->emergency_relation ?? '';
            $addProfile->emergency_phn_number = $request->emergency_phn_number ?? 0;
            $addProfile->emergency_email = $request->emergency_email ?? '';
            $addProfile->emergency_addr = $request->emergency_addr ?? '';
            $addProfile->emergency_district = $request->emergency_district ?? '';


            // if ($request->image) {
            //     $speaker_image_name = 'speaker_image_' . time() . '.png';
            //     Image::make($request->image)->save(public_path('uploads/images/speakers/'.$speaker_image_name));
            //     $updateSpeaker->image = $speaker_image_name;
            // }
            $addProfile->save();

            return response()->json([
                'success' =>  true,
                'data' =>  $addProfile,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' =>  false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Post(
     * tags={"PDS User Employee [Users]"},
     * path="/pds-backend/api/user/updateProfile",
     * operationId="updateProfile",
     * summary="Update User Employee",
     * description="Update User Employee",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *               @OA\Property(property="id", type="text"),
     *               @OA\Property(property="user_id", type="text"),
     *               @OA\Property(property="image", type="text"),
     *               @OA\Property(property="name", type="text"),
     *               @OA\Property(property="mobile_number", type="text"),
     *               @OA\Property(property="email", type="text"),
     *               @OA\Property(property="designation", type="text"),
     *               @OA\Property(property="present_addr_houseno", type="text"),
     *               @OA\Property(property="present_addr_roadno", type="text"),
     *               @OA\Property(property="present_addr_area", type="text"),
     *               @OA\Property(property="present_addr_upazila", type="text"),
     *               @OA\Property(property="present_addr_district", type="text"),
     *               @OA\Property(property="present_addr_postcode", type="text"),
     *               @OA\Property(property="permanent_addr_houseno", type="text"),
     *               @OA\Property(property="permanent_addr_roadno", type="text"),
     *               @OA\Property(property="permanent_addr_area", type="text"),
     *               @OA\Property(property="permanent_addr_upazila", type="text"),
     *               @OA\Property(property="permanent_addr_district", type="text"),
     *               @OA\Property(property="permanent_addr_postcode", type="text"),
     *               @OA\Property(property="department", type="text"),
     *               @OA\Property(property="job_location", type="text"),
     *               @OA\Property(property="joining_date", type="text"),
     *               @OA\Property(property="education_history", type="text"),
     *               @OA\Property(property="father_name", type="text"),
     *               @OA\Property(property="mother_name", type="text"),
     *               @OA\Property(property="spouse_name", type="text"),
     *               @OA\Property(property="number_of_cheild", type="text"),
     *               @OA\Property(property="emergency_name", type="text"),
     *               @OA\Property(property="emergency_relation", type="text"),
     *               @OA\Property(property="emergency_email", type="text"),
     *               @OA\Property(property="emergency_addr", type="text"),
     *               @OA\Property(property="emergency_distict", type="text"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Updated Guest Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function updateProfile(Request $request)
    {

        try {

            $Employee = Employee::where('user_id', $request->user_id)->first();
            $target = Employee::find($Employee->id);

            $image = $target->image ?? '';

            if (!empty($request->image)) {
                $fileName = 'photo-' . uniqid() . '-' . date("Y-M-D") . ".png";
                Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('/images/' . $fileName));
                $image = $fileName;

                if (File::exists(public_path('/images/' . $target->image))) {
                    File::delete(public_path('/images/' . $target->image));
                }
            }

            $updateArr = [
                'image' => $image ?? $target->image,
                'name' => $request->name,
                'status' => $request->status,
                'user_id' => $request->user_id,
                'mobile_number' => $request->mobile_number ?? $target->mobile_number,
                'email' => $request->email ?? $target->email,
                'designation' => $request->designation ?? $target->designation,
                'present_addr_houseno' => $request->present_addr_houseno ?? $target->present_addr_houseno,
                'present_addr_roadno' => $request->present_addr_roadno ?? $target->present_addr_roadno,
                'present_addr_area' => $request->present_addr_area ?? $target->present_addr_area,
                'present_addr_upazila' => $request->present_addr_upazila ?? $target->present_addr_upazila,
                'present_addr_district' => $request->present_addr_district ?? $target->present_addr_district,
                'present_addr_postcode' => $request->present_addr_postcode ?? $target->present_addr_postcode,
                'permanent_addr_houseno' => $request->permanent_addr_houseno ?? $target->permanent_addr_houseno,
                'permanent_addr_roadno' => $request->permanent_addr_roadno ?? $target->permanent_addr_roadno,
                'permanent_addr_area' => $request->permanent_addr_area ?? $target->permanent_addr_area,
                'permanent_addr_upazila' => $request->permanent_addr_upazila ?? $target->permanent_addr_upazila,
                'permanent_addr_district' => $request->permanent_addr_district ?? $target->permanent_addr_district,
                'permanent_addr_postcode' => $request->permanent_addr_postcode ?? $target->permanent_addr_postcode,
                'department' => $request->department ?? $target->department,
                'job_location' => $request->job_location ?? $target->job_location,
                'joining_date' => $request->joining_date ?? $target->joining_date,
                'education_history' => $request->education_history ?? [],
                'father_name' => $request->father_name ?? $target->father_name,
                'mother_name' => $request->mother_name ?? $target->mother_name,
                'spouse_name' => $request->spouse_name ?? $target->spouse_name,
                'number_of_child' => $request->number_of_child ?? $target->number_of_child,
                'emergency_name' => $request->emergency_name ?? $target->emergency_name,
                'emergency_relation' => $request->emergency_relation ?? $target->emergency_relation,
                'emergency_phn_number' => $request->emergency_phn_number ?? $target->emergency_phn_number,
                'emergency_email' => $request->emergency_email ?? $target->emergency_email,
                'emergency_addr' => $request->emergency_addr ?? $target->emergency_addr,
                'emergency_district' => $request->emergency_district ?? $target->emergency_district,
            ];

            $updateProfile = Employee::where('id', $Employee->id)->update($updateArr);

            return response()->json([
                'status'  => true,
                'message' => "Employee Update Successfully",
                'errors'  => null,
                'data'    => $updateProfile,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * @OA\Post(
     *     tags={"PDS User Employee [Users]"},
     *     path="/pds-backend/api/user/deleteEmployee/{empid}/{userid}",
     *     operationId="deleteEmployee",
     *     summary="Delete User Employee",
     *     description="Delete both the User and Employee records associated with the given IDs.",
     *     @OA\Parameter(
     *         name="empid",
     *         in="path",
     *         required=true,
     *         description="Employee ID to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="userid",
     *         in="path",
     *         required=true,
     *         description="User ID to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Employee and User deleted successfully",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     security={{"bearer_token":{}}}
     * )
     */


    public function deleteEmployee($empid, $userid)
    {

        // return $empid.'__'.$userid;


        try {

            $employee = Employee::find($empid);
            if ($employee->delete()) {
                User::find($userid)->delete();
            }


            // $user = User::find($userid);
            // $user->delete();

            // return $employee;
            return response()->json([
                'status' => true,
                'message' => 'Employee deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
