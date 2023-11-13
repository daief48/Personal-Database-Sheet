<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Designation;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;
use Validator;


class DesignationController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp)
    {
        //$this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }

    /**
     * @OA\Get(
     * tags={"PDS Designation Setup"},
     * path= "/pds-backend/api/getDesignationMgt",
     * operationId="getDesignationMgt",
     * summary="Designation Mgt List",
     * description="Total Designation Mgt List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getDesignationMgt()
    {
        try {

            $getDesignationSetup = Designation::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $getDesignationSetup,
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
     * tags={"PDS Designation Setup"},
     * path="/pds-backend/api/addDesignationMgt",
     * operationId="addDesignationMgt",
     * summary="Add New Designation Mgt",
     * description="Add New Designation Mgt",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *               @OA\Property(property="employee_id", type="integer"),
     *               @OA\Property(property="designation_name", type="text"),
     *               @OA\Property(property="create_at", type="text"),
     *               @OA\Property(property="status", type="text"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Added Designation Mgt Setup Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function addDesignationMgt(Request $request)
    {
        try {

            $rules = [
                'employee_id' => 'required',
                'designation_name' => 'required',
                'create_at' => 'required',
                'status' => 'required',

            ];

            $messages = [
                'employee_id.required' => 'The employee_id field is required',
                'designation_name.required' => 'The designation_name field is required',
                'create_at.required' => 'The create_at field is required',
                'status.required' => 'The status field is required',

            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $designationInfo = Designation::create([
                'employee_id' => $request->employee_id,
                'designation_name' => $request->designation_name,
                'create_at' => $request->create_at,
                'status' => $request->status,
            ]);

            return response()->json([
                'status'  => true,
                'message' => "Designation Mgt Created Successfully",
                'errors'  => null,
                'data'    => $designationInfo,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Put(
     * tags={"PDS Designation Setup"},
     * path="/pds-backend/api/updateDesignationMgt/{id}",
     * operationId="updateDesignationMgt",
     * summary="Update Designation Mgt Setup",
     * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     * @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="employee_id", type="integer", example=1),
     *              @OA\Property(property="designation_name", type="text", example="xyz"),
     *              @OA\Property(property="create_at", type="text", example="2023-03-23"),
     *              @OA\Property(property="status", type="text", example=0),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Designation Mgt Setup Update Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function updateDesignationMgt(Request $request, $id)
    {

        try {

            $rules = [
                'designation_name' => 'required',
                'create_at' => 'required',
                'status' => 'required',

            ];

            $messages = [
                'designation_name.required' => 'The designation_name field is required',
                'create_at.required' => 'The create_at field is required',
                'status.required' => 'The status field is required',

            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            $designationInfoById = Designation::findOrFail($id);
            $designationInfo = Designation::findOrFail($id);
            $designationInfo->designation_name = $request->designation_name;
            $designationInfo->create_at = $request->create_at;
            $designationInfo->status = $request->status;
            $designationInfo->save();

            return response()->json([
                'status'  => true,
                'message' => "Designation Mgt Updated Successfully",
                'errors'  => null,
                'data'    => $designationInfo,
                'designationInfoById' => $designationInfoById,

            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Delete(
     *     path="/pds-backend/api/deleteDesignationMgt/{id}",
     *     tags={"PDS Designation Setup"},
     *     summary="Delete Designation Mgt Record",
     *     description="Delete Designation Mgt Record With Valid ID",
     *     operationId="deleteDesignationMgt",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Delete Office Mgt Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function deleteDesignationMgt($id)
    {
        try {
            $designationMgt =  Designation::findOrFail($id);
            $designationMgt->delete();

            return response()->json([
                'status'  => true,
                'message' => "Designation Mgt Record Deleted Successfully",
                'errors'  => null,
                'data'    => $designationMgt,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/inactiveDesignationMgtRecord/{id}",
     *     tags={"PDS Designation Setup"},
     *     summary="In-active Designation Mgt Record",
     *     description="In-active Specific Designation Mgt Record With Valid ID",
     *     operationId="inactiveDesignationMgtRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, In-active Designation Mgt Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function inactiveDesignationMgtRecord($id)
    {
        try {
            $designationMgtInfo =  Designation::find($id);

            if (!($designationMgtInfo === null)) {
                $designationMgtInfo = Designation::where('id', '=', $id)->update(['status' => 2]);
                return response()->json([
                    'status'  => true,
                    'message' => "Inactived Designation Mgt Successfully",
                    'errors'  => null,
                    'data'    => $designationMgtInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Designation Mgt Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/activeDesignationMgtRecord/{id}",
     *     tags={"PDS Designation Setup"},
     *     summary="Active Designation Mgt Record",
     *     description="Active Specific Designation Mgt Record With Valid ID",
     *     operationId="activeDesignationMgtRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Active Designation Mgt Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function activeDesignationMgtRecord($id)
    {
        try {
            $designationMgtInfo = Designation::find($id);

            if (!($designationMgtInfo === null)) {
                $designationMgtInfo = Designation::where('id', '=', $id)->update(['status' => 1]);
                return response()->json([
                    'status'  => true,
                    'message' => "Actived Designation Mgt Record Successfully",
                    'errors'  => null,
                    'data'    => $designationMgtInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Designation Mgt Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Get(
     *     tags={"PDS Designation Setup"},
     * path="/pds-backend/api/specificDesigSetup/{id}",
     * operationId="specificDesigSetup",
     * summary="Specific Dept Setup",
     * description="",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function specificDesigSetup(Request $request)
    {
        try {
            $specificDesigSetup = Designation::findOrFail($request->id);
            return response()->json([
                'status' => 'success',
                'data' => $specificDesigSetup,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }
}
