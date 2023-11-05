<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BloodGroup;
use Illuminate\Http\Response;
use Validator;
use App\Repositories\ResponseRepository;

class BloodGroupController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp)
    {
        //$this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }



    /**
     * @OA\Get(
     * tags={"PDS User BloodGroup"},
     * path= "/pds-backend/api/getBloodGroup",
     * operationId="getBloodGroup",
     * summary="BloodGroup List",
     * description="Total BloodGroup List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getBloodGroup()
    {
        try {

            $getBloodGroup = BloodGroup::leftJoin('employees', 'employees.id', '=', 'blood_groups.employee_id')
                ->select(
                    'blood_groups.*',
                    'employees.id as emp_id',
                    'employees.name',
                    'employees.mobile_number',

                )->orderBy('id', 'desc')->get();

            return response()->json([
                'status' => 'success',
                'list' => $getBloodGroup,
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
     * tags={"PDS User BloodGroup"},
     * path= "/pds-backend/api/getBloodGroupByEmployeeId/{employee_id}",
     * operationId="getBloodGroupByEmployeeId",
     * summary="BloodGroup List",
     * description="Total BloodGroup List",
     *  @OA\Parameter(
     *         name="employee_id", description="Employee ID",  example=1, required=true,in="path",@OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Success"),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Not Found"),
     *     security={{"bearer_token": {}}}
     * )
     */

    public function getBloodGroupByEmployeeId(Request $request)
    {
        try {

            $getBloodGroup = BloodGroup::leftJoin('employees', 'employees.id', '=', 'blood_groups.employee_id')
                ->select(
                    'blood_groups.*',
                    'employees.id as emp_id',
                    'employees.name',
                    'employees.mobile_number',

                )->where('blood_groups.employee_id', $request->employee_id)
                ->orderBy('id', 'desc')->get();

            return response()->json([
                'status' => 'success',
                'list' => $getBloodGroup,
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
     * tags={"PDS User BloodGroup"},
     * path="/pds-backend/api/addBloodGroup",
     * operationId="addBloodGroup",
     * summary="Add New BloodGroup",
     * description="Add New BloodGroup",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *               @OA\Property(property="employee_id", type="integer",example=1),
     *               @OA\Property(property="blood_group", type="integer"),
     *                @OA\Property(property="last_donate", type="integer"),
     *               @OA\Property(property="status", type="integer"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Added BloodGroup Record Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */



    public function addBloodGroup(Request $request)
    {
        try {
            $rules = [
                'employee_id' => 'required|unique:blood_groups',
                'blood_group' => 'required',
                'last_donate' => 'required',
            ];

            $messages = [
                'employee_id.unique' => 'The employee_id is already exists',

                'employee_id.required' => 'The employee_id field is required',
                'blood_group.required' => 'The BloodGroup_ref_number field is required',
                'last_donate.required' => 'The last_donate field is required',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }


            $total_amount = $request->last_donate + $request->medical_allowance + $request->house_rent + $request->others;

            $BloodGroup = BloodGroup::create([
                'employee_id' => $request->employee_id,
                'blood_group' => $request->blood_group,
                'last_donate' => $request->last_donate,
                'status' => $request->status ?? 0,
            ]);

            return response()->json([
                'status'  => true,
                'message' => "BloodGroup Created Successfully",
                'errors'  => null,
                'data'    => $BloodGroup,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Put(
     * tags={"PDS User BloodGroup"},
     * path="/pds-backend/api/updateBloodGroup/{id}",
     * operationId="updateBloodGroup",
     * summary="Update BloodGroup Record",
     * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     * @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="employee_id", type="integer", example=1),
     *              @OA\Property(property="blood_group", type="integer", example=2),
     *              @OA\Property(property="last_donate", type="integer", example=2),
     *              @OA\Property(property="status", type="integer", example=1),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="BloodGroup Record Update Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */


    public function updateBloodGroup(Request $request, $id)
    {

        try {

            $rules = [
                'employee_id' => 'required',
                'blood_group' => 'required',
                'last_donate' => 'required',

            ];

            $messages = [
                // 'employee_id.unique' => 'The employee_id is already exists',

                'employee_id.required' => 'The employee_id field is required',
                'blood_group.required' => 'The BloodGroup_ref_number field is required',
                'last_donate.required' => 'The last_donate field is required',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $BloodGroup = BloodGroup::findOrFail($id);
            $BloodGroup->employee_id = $request->employee_id;
            $BloodGroup->blood_group = $request->blood_group;
            $BloodGroup->last_donate = $request->last_donate;
            $BloodGroup->status = $request->status;
            $BloodGroup->save();

            return response()->json([
                'status'  => true,
                'message' => "BloodGroup Updated Successfully",
                'errors'  => null,
                'data'    => $BloodGroup,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Delete(
     *     path="/pds-backend/api/deleteBloodGroup/{id}",
     *     tags={"PDS User BloodGroup"},
     *     summary="Delete BloodGroup Record",
     *     description="Delete  BloodGroup Record With Valid ID",
     *     operationId="deleteBloodGroup",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Delete BloodGroup Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function deleteBloodGroup($id)
    {
        try {
            $BloodGroup =  BloodGroup::findOrFail($id);
            $BloodGroup->delete();

            return response()->json([
                'status'  => true,
                'message' => "BloodGroup Record Deleted Successfully",
                'errors'  => null,
                'data'    => $BloodGroup,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/activeBloodGroupRecord/{id}",
     *     tags={"PDS User BloodGroup"},
     *     summary="Active BloodGroup Record",
     *     description="Active Specific BloodGroup Record With Valid ID",
     *     operationId="activeBloodGroupRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Active BloodGroup Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function activeBloodGroupRecord($id)
    {
        try {
            $BloodGroupInfo =  BloodGroup::find($id);

            if (!($BloodGroupInfo === null)) {
                $BloodGroupInfo = BloodGroup::where('id', '=', $id)->update(['status' => 1]);
                return response()->json([
                    'status'  => true,
                    'message' => "Actived BloodGroup Record Successfully",
                    'errors'  => null,
                    'data'    => $BloodGroupInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'BloodGroup Record Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/inactiveBloodGroupRecord/{id}",
     *     tags={"PDS User BloodGroup"},
     *     summary="In-active BloodGroup Record",
     *     description="In-active Specific BloodGroup Record With Valid ID",
     *     operationId="inactiveBloodGroupRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, In-active BloodGroup Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function inactiveBloodGroupRecord($id)
    {
        try {
            $BloodGroupInfo =  BloodGroup::find($id);

            if (!($BloodGroupInfo === null)) {
                $BloodGroupInfo = BloodGroup::where('id', '=', $id)->update(['status' => 2]);
                return response()->json([
                    'status'  => true,
                    'message' => "Inactived BloodGroup  Record Successfully",
                    'errors'  => null,
                    'data'    => $BloodGroupInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'BloodGroup Record Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
