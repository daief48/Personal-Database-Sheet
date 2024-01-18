<?php

namespace App\Http\Controllers;

use App\Models\BloodGroup;
use Illuminate\Support\Facades\Hash;
use App\Repositories\ResponseRepository;
use App\Models\Employee;
use App\Models\FreedomFighter;
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
     *      @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search term for filtering profiles",
     *         required=false,
     *         @OA\Schema(type="string"),
     *     ),
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
                ->leftJoin('offices', 'offices.id', '=', 'employees.office')
                ->leftJoin('freedom_fighters', 'freedom_fighters.employee_id', '=', 'employees.id')
                ->select(
                    'employees.*',
                    'employees.id as emp_id',
                    'employees.status as emp_status',
                    'departments.dept_name as department_name',
                    'designations.designation_name as designation_name',
                    'freedom_fighters.*'
                )
                ->orderBy('employees.id', 'desc');


            if (!empty($request->search)) {
                $employeeList = $employeeList->where('employees.name', 'like', '%' . $request->search . '%')
                    ->orWhere('employees.email', 'like', '%' . $request->search . '%')
                    ->orWhere('employees.mobile_number', 'like', '%' . $request->search . '%')
                    ->orWhere('departments.dept_name', 'like', '%' . $request->search . '%')
                    ->orWhere('designations.designation_name', 'like', '%' . $request->search . '%')
                    ->orWhere('offices.office_name', 'like', '%' . $request->search . '%');
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
                ->leftJoin('offices', 'offices.id', '=', 'employees.office')
                ->leftJoin('grades', 'grades.id', '=', 'employees.job_grade')
                ->select(
                    'employees.*',
                    'designations.id as designation_id',
                    'designations.designation_name as designation',
                    'departments.id as department_id',
                    'departments.dept_name as department',
                    'offices.office_name as office_name',
                    'grades.job_grade as job_grade_name'

                )
                ->where('employees.user_id', $id)->first();

            // $imgContent = public_path('/images/' . $getProfile->image);
            // $contents = file_get_contents($imgContent);
            // $baseEncode = 'data:image/png; base64,' . base64_encode($contents);


            return response()->json([
                'status' => 'success',
                'data'   => $getProfile,
                // 'encodeImg' => $baseEncode
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    /**
     * @OA\Get(
     * tags={"PDS User Employee [Users]"},
     * path="/pds-backend/api/user/getEmployeeById/{id}",
     * operationId="getEmployeeById",
     * summary="Get User Employee List",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getEmployeeById(Request $request, $id)
    {
        try {

            $getProfile = Employee::find($id);

            // $imgContent = public_path('/images/' . $getProfile->image);
            // $contents = file_get_contents($imgContent);
            // $baseEncode = 'data:image/png; base64,' . base64_encode($contents);


            return response()->json([
                'status' => 'success',
                'data'   => $getProfile,
                // 'encodeImg' => $baseEncode
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
   
     *               @OA\Property(property="image", type="text"),
     *               @OA\Property(property="name", type="text"),
     *                @OA\Property(property="gender", type="text"),
     *               @OA\Property(property="mobile_number", type="text"),
     *               @OA\Property(property="email", type="text"),
     *                @OA\Property(property="date_of_birth", type="date"),
     *                @OA\Property(property="blood_group", type="text"),
     *                @OA\Property(property="nid_number", type="text"),
     *                @OA\Property(property="passport_number", type="text"),
     *               @OA\Property(property="designation", type="text"),
     *                @OA\Property(property="office", type="text"),
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
     *               @OA\Property(property="job_grade", type="text"),
     *               @OA\Property(property="job_location", type="text"),
     *               @OA\Property(property="joining_date", type="text"),
     *                @OA\Property(property="freedom_fighter_status", type="text"),
     *                @OA\Property(property="freedom_fighter_num", type="text"),
     *                @OA\Property(property="Sector", type="text"),
     *                @OA\Property(property="fighting_divi", type="text"),
     *               @OA\Property(property="education_history", type="text"),
     *                @OA\Property(property="document", type="text"),
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
            $addProfile->gender = $request->gender ?? ''; //
            $addProfile->mobile_number = $request->mobileNumber ?? 0; //
            $addProfile->email = $request->email ?? ''; //
            $addProfile->date_of_birth = $request->date_of_birth ?? ''; //
            $addProfile->blood_group = $request->blood_group ?? ''; //
            $addProfile->nid_number = $request->nid_number ?? 0; //
            $addProfile->passport_number = $request->passport_number ?? 0; //
            $addProfile->designation = $request->designation;
            $addProfile->office = $request->office;
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
            $addProfile->job_grade = $request->job_grade ?? '';
            $addProfile->joining_date = $request->joining_date ?? '2000-02-22';
            $addProfile->freedom_fighter_status = $request->freedom_fighter_status ?? 0;
            // $addProfile->education_history = $request->education_history ?? [];
            // $addProfile->document = $request->document ?? [];
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

            $freedom_fighter_num = $request->freedom_fighter_num;
            $Sector = $request->Sector;
            $fighting_divi = $request->fighting_divi;
            $addFreedomFighter = new FreedomFighter;
            $addFreedomFighter->employee_id = $addProfile->id;
            $addFreedomFighter->freedom_fighter_num = $freedom_fighter_num ?? ''; //
            $addFreedomFighter->Sector = $Sector ?? ''; //
            $addFreedomFighter->fighting_divi = $fighting_divi ?? ''; //freedom_fighter_status
            if (!empty($freedom_fighter_num) || !empty($Sector) || !empty($fighting_divi)) {
                // Save the record if at least one of the specified fields is not empty
                $addFreedomFighter->save();
            }

            $bloodGroup = $request->blood_group;
            $addBloodGroud = new BloodGroup();
            $addBloodGroud->employee_id = $addProfile->id;
            $addBloodGroud->blood_group = $request->blood_group ?? ''; //
            if (!empty($bloodGroup)) {
                // Save the record if at least one of the specified fields is not empty
                $addBloodGroud->save();
            }

            return response()->json([
                'success' =>  true,
                'profileData' =>  $addProfile,
                // 'freedomfighterData' =>  $addProfile,
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
     *                @OA\Property(property="gender", type="text"),
     *               @OA\Property(property="name", type="text"),
     *               @OA\Property(property="mobile_number", type="text"),
     *               @OA\Property(property="email", type="text"),
     *                  @OA\Property(property="date_of_birth", type="date"),
     *                @OA\Property(property="blood_group", type="text"),
     *                @OA\Property(property="nid_number", type="text"),
     *                @OA\Property(property="passport_number", type="text"),
     *               @OA\Property(property="designation", type="text"),
     *                @OA\Property(property="office", type="text"),
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
     *               @OA\Property(property="job_grade", type="text"),
     *               @OA\Property(property="job_location", type="text"),
     *               @OA\Property(property="joining_date", type="text"),
     *               @OA\Property(property="freedom_fighter_status", type="text"),
     *               @OA\Property(property="freedom_fighter_num", type="text"),
     *               @OA\Property(property="Sector", type="text"),
     *               @OA\Property(property="fighting_divi", type="text"),
     *               @OA\Property(property="education_history", type="text"),
     *               @OA\Property(property="document", type="text"),
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



            //  return $request->input(); 
            $Employee = Employee::where('user_id', $request->user_id)->first();

            $target = Employee::find($Employee->id);

            $image = $target->image ?? '';

            if (!empty($request->image)) {
                $fileName = 'photo-' . uniqid() . '-' . date("Y-M-D") . ".png";
                Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('/images/' . $fileName));
                $image = $fileName;
                $updateArr['image'] = $image;

                if (File::exists(public_path('/images/' . $target->image))) {
                    File::delete(public_path('/images/' . $target->image));
                }
            }




            if ($request->designation != 'null') {
                $updateArr['designation'] = $request->designation;
            }

            if ($request->department != 'null') {
                $updateArr['department'] = $request->department;
            }
            if ($request->nid_number != 'null') {
                $updateArr['nid_number'] = $request->nid_number;
            }

            if ($request->passport_number != 'null') {
                $updateArr['passport_number'] = $request->passport_number;
            }

            if ($request->office != 'null') {
                $updateArr['office'] = $request->office;
            }
            if ($request->name != 'null') {
                $updateArr['name'] = $request->name;
            }
            if ($request->gender != 'null') {
                $updateArr['gender'] = $request->gender;
            }
            if ($request->status != 'null') {
                $updateArr['status'] = $request->status;
            }
            if ($request->user_id != 'null') {
                $updateArr['user_id'] = $request->user_id;
            }
            if ($request->mobile_number != 'null') {
                $updateArr['mobile_number'] = $request->mobile_number;
            }
            if ($request->email != 'null') {
                $updateArr['email'] = $request->email;
            }
            if ($request->date_of_birth != 'null') {
                $updateArr['date_of_birth'] = $request->date_of_birth;
            }
            if ($request->blood_group != 'null') {
                $updateArr['blood_group'] = $request->blood_group;
            }
            if (($request->present_addr_houseno != 'null')) {
                $updateArr['present_addr_houseno'] = $request->present_addr_houseno;
            }
            if ($request->present_addr_roadno != 'null') {
                $updateArr['present_addr_roadno'] = $request->present_addr_roadno;
            }
            if ($request->present_addr_area != 'null') {
                $updateArr['present_addr_area'] = $request->present_addr_area;
            }
            if ($request->present_addr_upazila != 'null') {
                $updateArr['present_addr_upazila'] = $request->present_addr_upazila;
            }
            if ($request->present_addr_district != 'null') {
                $updateArr['present_addr_district'] = $request->present_addr_district;
            }
            if ($request->present_addr_postcode != 'null') {
                $updateArr['present_addr_postcode'] = $request->present_addr_postcode;
            }
            if ($request->permanent_addr_houseno != 'null') {
                $updateArr['permanent_addr_houseno'] = $request->permanent_addr_houseno;
            }
            if ($request->permanent_addr_roadno != 'null') {
                $updateArr['permanent_addr_roadno'] = $request->permanent_addr_roadno;
            }
            if ($request->permanent_addr_area != 'null') {
                $updateArr['permanent_addr_area'] = $request->permanent_addr_area;
            }
            if ($request->permanent_addr_upazila != 'null') {
                $updateArr['permanent_addr_upazila'] = $request->permanent_addr_upazila;
            }
            if ($request->permanent_addr_district != 'null') {
                $updateArr['permanent_addr_district'] = $request->permanent_addr_district;
            }
            if ($request->permanent_addr_postcode != 'null') {
                $updateArr['permanent_addr_postcode'] = $request->permanent_addr_postcode;
            }
            if ($request->job_grade != 'null') {
                $updateArr['job_grade'] = $request->job_grade;
            }
            if ($request->job_location != 'null') {
                $updateArr['job_location'] = $request->job_location;
            }
            if ($request->joining_date != 'null') {
                $updateArr['joining_date'] = $request->joining_date;
            }
            if ($request->education_history != 'null') {
                $updateArr['education_history'] = $request->education_history ?? [];
            }
            if ($request->document != 'null') {
                $updateArr['document'] = $request->document ?? [];
            }
            if ($request->father_name != 'null') {
                $updateArr['father_name'] = $request->father_name;
            }
            if ($request->mother_name != 'null') {
                $updateArr['mother_name'] = $request->mother_name;
            }
            if ($request->spouse_name != 'null') {
                $updateArr['spouse_name'] = $request->spouse_name;
            }
            if ($request->number_of_child != 'null') {
                $updateArr['number_of_child'] = $request->number_of_child;
            }
            if ($request->emergency_name != 'null') {
                $updateArr['emergency_name'] = $request->emergency_name;
            }
            if ($request->emergency_relation != 'null') {
                $updateArr['emergency_relation'] = $request->emergency_relation;
            }
            if ($request->emergency_phn_number != 'null') {
                $updateArr['emergency_phn_number'] = $request->emergency_phn_number;
            }
            if ($request->emergency_email != 'null') {
                $updateArr['emergency_email'] = $request->emergency_email;
            }
            if ($request->emergency_addr != 'null') {
                $updateArr['emergency_addr'] = $request->emergency_addr;
            }
            if ($request->emergency_district != 'null') {
                $updateArr['emergency_district'] = $request->emergency_district;
            }

            $updateProfile = Employee::where('id', $Employee->id)->update($updateArr);

            $bloodGroup = BloodGroup::where('employee_id', $Employee->id)->first();

            // return $bloodGroup
            if ($bloodGroup) {
                // If the record exists, update its values
                $bloodGroup->blood_group = $request->blood_group;
                $bloodGroup->last_donate = now();
                $bloodGroup->save();
            } else {
                // If the record does not exist, create a new one
                $bloodGroup = new BloodGroup();
                $bloodGroup->employee_id = $Employee->id;
                $bloodGroup->blood_group = $request->blood_group;
                $bloodGroup->last_donate = now();
                $bloodGroup->save();
            }



            // $freedomFighter = FreedomFighter::where('employee_id', $request->id)->first();

            // $target = FreedomFighter::find($freedomFighter->id);
            // $addFreedomFighter = [
            //     'freedom_fighter_num' => $request->freedom_fighter_num ?? $target->freedom_fighter_num,
            //     'Sector' => $request->Sector ?? $target->Sector,
            //     'fighting_divi' => $request->fighting_divi ?? $target->fighting_divi,
            // ];
            // $updateaddFreedomFighter = FreedomFighter::where('id', $freedomFighter->id)->update($addFreedomFighter);

            return response()->json([
                'status'  => true,
                'message' => "Employee Update Successfully",
                'errors'  => null,
                'profiledata'    => $updateProfile,
                // 'freedomfighterdata'    => $updateaddFreedomFighter,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * @OA\Post(
     *     tags={"PDS User Employee [Users]"},
     *     path="/pds-backend/api/user/deleteEmployee/{userid}",
     *     operationId="deleteEmployee",
     *     summary="Delete User Employee",
     *     description="Delete both the User and Employee records associated with the given IDs.",
 
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


    public function deleteEmployee($userid)
    {

        // return $empid.'__'.$userid;


        try {

            $employee = User::find($userid);
            if ($employee->delete()) {
                Employee::find($userid)->delete();
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

    /**
     * @OA\Get(
     *     path="/pds-backend/api/user/activeEmployeeType/{id}",
     *     tags={"PDS User Employee [Users]"},
     *     summary="Activate Transfer Type Record",
     *     description="Activate a specific Transfer Type Record with a valid ID",
     *     operationId="activeEmployeeType",
     *     @OA\Parameter(
     *         name="id",
     *         description="ID of the Transfer Type",
     *         example=1,
     *         required=true,
     *         in="path",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Successfully activated Transfer Type Record"),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     security={{"bearer_token":{}}}
     * )
     */

    public function activeEmployeeType($id)
    {
        try {
            $transferTypeInfo = Employee::find($id);

            $transferTypeInfo;
            if (!is_null($transferTypeInfo)) {
                Employee::where('id', '=', $id)->update(['status' => 1]);

                return response()->json([
                    'status'  => true,
                    'message' => "Activated Transfer Type Record Successfully",
                    'errors'  => null,
                    'data'    => $transferTypeInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Transfer Type ID is not valid!');
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
     * @OA\Get(
     *     path="/pds-backend/api/user/inactiveEmployeeType/{id}",
     *     tags={"PDS User Employee [Users]"},
     *     summary="Activate Transfer Type Record",
     *     description="Inactivate a specific Transfer Type Record with a valid ID",
     *     operationId="inactiveEmployeeType",
     *     @OA\Parameter(
     *         name="id",
     *         description="ID of the Transfer Type",
     *         example=1,
     *         required=true,
     *         in="path",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Successfully activated Transfer Type Record"),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     security={{"bearer_token":{}}}
     * )
     */

    public function inactiveEmployeeType($id)
    {
        try {
            $transferTypeInfo = Employee::find($id);

            $transferTypeInfo;
            if (!is_null($transferTypeInfo)) {
                Employee::where('id', '=', $id)->update(['status' => 0]);

                return response()->json([
                    'status'  => true,
                    'message' => "Activated Transfer Type Record Successfully",
                    'errors'  => null,
                    'data'    => $transferTypeInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Transfer Type ID is not valid!');
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
 * @OA\Post(
 *     path="/pds-backend/api/user/fileUpload",
 *     tags={"PDS User Employee [Users]"},
 *     summary="Upload a Document File",
 *     description="Upload a document file to the server",
 *     operationId="fileUpload",
 *     @OA\RequestBody(
 *         required=true,
 *         description="File to upload",
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 @OA\Property(
 *                     property="document_file",
 *                     description="File to be uploaded",
 *                     type="string",
 *                     format="binary",
 *                 ),
 *             ),
 *         ),
 *     ),
 *     @OA\Response(response=200, description="Successfully uploaded file"),
 *     @OA\Response(response=400, description="Bad Request"),
 *     @OA\Response(response=500, description="Internal Server Error"),
 *     security={{"bearer_token":{}}}
 * )
 */
public function fileUpload(Request $request)
{
    try {
        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $file_name = $file->getClientOriginalName();

            $destinationPath = public_path("/document_files/");
            $file->move($destinationPath, $file_name);

            // You can add additional logic or response here if needed

            return response()->json([
                'status'  => true,
                'message' => 'Successfully uploaded file',
                'errors'  => null,
                'data'    => $file_name,
            ], 200);
        } else {
            return $this->responseRepository->ResponseError(
                null,
                'No file uploaded',
                Response::HTTP_BAD_REQUEST
            );
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
