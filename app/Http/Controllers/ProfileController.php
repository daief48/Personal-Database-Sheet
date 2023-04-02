<?php

namespace App\Http\Controllers;
use App\Repositories\ResponseRepository;
use App\Models\Profile;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Image;

class ProfileController extends Controller
{
    protected $responseRepository;
    public function __construct(ResponseRepository $rr,)
    {
       // $this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rr;
    }

    /**
     * @OA\Get(
     * tags={"PDS User Profile [Users]"},
     * path= "/pds-backend/api/user/getAllProfile",
     * operationId="getAllProfile",
     * summary="Get All Profile List",
     * description="Get All Profile List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

     public function getAllProfile(){
        try {

            $getAllProfile = Profile::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $getAllProfile,
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
    * tags={"PDS User Profile [Users]"},
    * path="/pds-backend/api/user/getprofile/{id}",
    * operationId="getprofile",
    * summary="Get User Profile List",
    * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
    * @OA\Response(response=200, description="Success" ),
    * @OA\Response(response=400, description="Bad Request"),
    * @OA\Response(response=404, description="Resource Not Found"),
    * ),
    * security={{"bearer_token":{}}}
    */

    public function getprofile(Request $request){
        try {
            $getProfile = Profile::findOrFail($request->id);

            return response()->json([
                'status' => 'success',
                'data'   => $getProfile
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => "This id not found",
            ], 401);
        }
    }


   /**
    * @OA\Post(
    * tags={"PDS User Profile [Users]"},
    * path="/pds-backend/api/user/addProfile",
    * operationId="addProfile",
    * summary="Add User Profile",
    * description="Add User Profile",
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
    *          description="User Profile Added Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * ),
    *     security={{"bearer_token":{}}}
    */

    public function addProfile(Request $request){

        try {

            $addProfile = new Profile;
            $addProfile->user_id = $request->user_id ?? 0;
            $addProfile->image = $request->image ?? '';
            $addProfile->name = $request->name ?? '';
            $addProfile->mobile_number = $request->mobile_number ?? 0;
            $addProfile->email = $request->email ?? 'null';
            $addProfile->designation = $request->designation;
            $addProfile->present_addr_houseno = $present_addr_houseno ?? 0;
            $addProfile->present_addr_roadno = $request->present_addr_roadno ?? 0;
            $addProfile->present_addr_area = $request->present_addr_area ?? 'null';
            $addProfile->present_addr_upazila = $request->present_addr_upazila ?? 'null';
            $addProfile->present_addr_district = $request->present_addr_district ?? 'null';
            $addProfile->present_addr_postcode = $request->present_addr_postcode ?? 0;
            $addProfile->permanent_addr_houseno = $request->permanent_addr_houseno ?? 0;
            $addProfile->permanent_addr_roadno = $request->permanent_addr_roadno ?? 0;
            $addProfile->permanent_addr_area = $request->permanent_addr_area ?? 'null';         
            $addProfile->permanent_addr_upazila = $request->permanent_addr_upazila ?? 'null';
            $addProfile->permanent_addr_district = $request->permanent_addr_district ?? 'null';
            $addProfile->permanent_addr_postcode = $request->permanent_addr_postcode ?? 0;
            $addProfile->department = $request->department ?? 0;
            $addProfile->job_location = $request->job_location ?? 'null';
            $addProfile->joining_date = $request->joining_date ?? '2000-02-22';
            $addProfile->education_history = $request->education_history ?? 'null';
            $addProfile->father_name = $request->father_name ?? 'null';
            $addProfile->mother_name = $request->mother_name ?? 'null';
            $addProfile->spouse_name = $request->spouse_name ?? 'null';
            $addProfile->number_of_cheild = $request->number_of_cheild ?? 0;
            $addProfile->emergency_name = $request->emergency_name ?? 'null';
            $addProfile->emergency_relation = $request->emergency_relation ?? 'null';
            $addProfile->emergency_phn_number = $request->emergency_phn_number ?? 0;
            $addProfile->emergency_email = $request->emergency_email ?? 'null';
            $addProfile->emergency_addr = $request->emergency_addr ?? 'null';
            $addProfile->emergency_distict = $request->emergency_distict ?? 'null';


            // if ($request->image) {
            //     $speaker_image_name = 'speaker_image_' . time() . '.png';
            //     Image::make($request->image)->save(public_path('uploads/images/speakers/'.$speaker_image_name));
            //     $updateSpeaker->image = $speaker_image_name;
            // }
            $addProfile->save();

            return $this->responseRepository->ResponseSuccess($addProfile, "Success","User Profile Saved successfully.", 200);

        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
    * @OA\Post(
    * tags={"PDS User Profile [Users]"},
    * path="/pds-backend/api/user/updateProfile",
    * operationId="updateProfile",
    * summary="Update User Profile",
    * description="Update User Profile",
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

    public function updateProfile(Request $request){

        try {

            $target = Profile::find($request->id);

            $image = $target->image ?? '';

            // if(!empty($request->image)){
            //     $fileName = 'photo-'.uniqid().'-'.date("Y-M-D").".png";
            //     Image::make($request->image)->resize(300, null, function ($constraint) {
            //         $constraint->aspectRatio();
            //     })->save(public_path('/uploads/images/photos/'.$fileName));
            //     $photo = $fileName;
            // }

            $updateArr = [
                'image' => $request->image ?? '',
                'name' => $request->name ?? '',
                'user_id' => $request->user_id ?? 0,
                'mobile_number' => $request->mobile_number ?? 0,
                'email' => $request->email ?? 'null',
                'designation' => $request->designation,
                'present_addr_houseno' => $present_addr_houseno ?? 0,
                'present_addr_roadno' => $request->present_addr_roadno ?? 0,
                'present_addr_area' => $request->present_addr_area ?? 'null',
                'present_addr_upazila' => $request->present_addr_upazila ?? 'null',
                'present_addr_district' => $request->present_addr_district ?? 'null',
                'present_addr_postcode' => $request->present_addr_postcode ?? 0,
                'permanent_addr_houseno' => $request->permanent_addr_houseno ?? 0,
                'permanent_addr_roadno' => $request->permanent_addr_roadno ?? 0,
                'permanent_addr_area' => $request->permanent_addr_area ?? 'null',         
                'permanent_addr_upazila' => $request->permanent_addr_upazila ?? 'null',
                'permanent_addr_district' => $request->permanent_addr_district ?? 'null',
                'permanent_addr_postcode' => $request->permanent_addr_postcode ?? 0,
                'department' => $request->department ?? 0,
                'job_location' => $request->job_location ?? 'null',
                'joining_date' => $request->joining_date ?? '2000-02-22',
                'education_history' => $request->education_history ?? 'null',
                'father_name' => $request->father_name ?? 'null',
                'mother_name' => $request->mother_name ?? 'null',
                'spouse_name' => $request->spouse_name ?? 'null',
                'number_of_cheild' => $request->number_of_cheild ?? 0,
                'emergency_name' => $request->emergency_name ?? 'null',
                'emergency_relation' => $request->emergency_relation ?? 'null',
                'emergency_phn_number' => $request->emergency_phn_number ?? 0,
                'emergency_email' => $request->emergency_email ?? 'null',
                'emergency_addr' => $request->emergency_addr ?? 'null',
                'emergency_distict' => $request->emergency_distict ?? 'null',
            ];

            $updateProfile = Profile::where('id', $request->id)->update($updateArr);

            return response()->json([
                'status'  => true,
                'message' => "Profile Update Successfully",
                'errors'  => null,
                'data'    => $updateProfile,
            ], 200);

        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    

}
