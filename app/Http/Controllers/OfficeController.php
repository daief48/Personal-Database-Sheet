<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Office;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;
use Validator;


class OfficeController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp)
    {
        //$this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }

    /**
     * @OA\Get(
     * tags={"PDS Office Setup"},
     * path= "/pds-backend/api/getOfficeMgt",
     * operationId="getOfficeMgt",
     * summary="Office Mgt List",
     * description="Total Office Mgt List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getOfficeMgt()
    {
        try {

            $getOfficeSetup = Office::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'list' => $getOfficeSetup,
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
     * tags={"PDS Office Setup"},
     * path="/pds-backend/api/addOfficeMgt",
     * operationId="addOfficeMgt",
     * summary="Add New Office Mgt",
     * description="Add New Office Mgt",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *                @OA\Property(property="employee_id", type="integer",example=1),
     *               @OA\Property(property="office_name", type="text"),
     *               @OA\Property(property="create_at", type="text"),
     *               @OA\Property(property="status", type="text"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Added Training Mgt Setup Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function addOfficeMgt(Request $request)
    {
        try {
            $rules = [

                'employee_id' => 'required',
                'office_name' => 'required',
                'create_at' => 'required',
                'status' => 'required',
                // Add validation rules for other fields here
            ];

            $messages = [

                'employee_id.required' => 'The employee_id field is required',
                'office_name.required' => 'The office_name field is required',
                'create_at.required' => 'The create_at field is required',
                'status.required' => 'The status field is required',
                // Add custom error messages for other fields if needed
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $OfficeInfo = Office::create([
                'employee_id' => $request->employee_id,
                'office_name' => $request->office_name,
                'create_at' => $request->create_at,
                'status' => $request->status,
            ]);

            return response()->json([
                'status'  => true,
                'message' => "Office Mgt Created Successfully",
                'errors'  => null,
                'data'    => $OfficeInfo,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Put(
     * tags={"PDS Office Setup"},
     * path="/pds-backend/api/updateOfficeMgt/{id}",
     * operationId="updateOfficeMgt",
     * summary="Update Office Mgt Setup",
     * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     * @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *                @OA\Property(property="employee_id", type="integer",example=1),
     *              @OA\Property(property="office_name", type="text", example="xyz"),
     *              @OA\Property(property="create_at", type="text", example="2023-03-23"),
     *              @OA\Property(property="status", type="text", example=0),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Office Mgt Setup Update Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function updateOfficeMgt(Request $request, $id)
    {

        try {
            $rules = [

                'employee_id' => 'required',
                'office_name' => 'required',
                'create_at' => 'required',
                'status' => 'required',
                // Add validation rules for other fields here
            ];

            $messages = [

                'employee_id.required' => 'The employee_id field is required',
                'office_name.required' => 'The office_name field is required',
                'create_at.required' => 'The create_at field is required',
                'status.required' => 'The status field is required',
                // Add custom error messages for other fields if needed
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $OfficeInfo = Office::findOrFail($id);
            $OfficeInfo->employee_id = $request->employee_id;
            $OfficeInfo->office_name = $request->office_name;
            $OfficeInfo->create_at = $request->create_at;
            $OfficeInfo->status = $request->status;
            $OfficeInfo->save();

            return response()->json([
                'status'  => true,
                'message' => "Office Mgt Updated Successfully",
                'errors'  => null,
                'data'    => $OfficeInfo,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Delete(
     *     path="/pds-backend/api/deleteOfficeMgt/{id}",
     *     tags={"PDS Office Setup"},
     *     summary="Delete Office Mgt Record",
     *     description="Delete Office Mgt Record With Valid ID",
     *     operationId="deleteOfficeMgt",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Delete Office Mgt Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function deleteOfficeMgt($id)
    {
        try {
            $officeMgt =  Office::findOrFail($id);
            $officeMgt->delete();

            return response()->json([
                'status'  => true,
                'message' => "Office Mgt Record Deleted Successfully",
                'errors'  => null,
                'data'    => $officeMgt,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/inactiveOfficeMgtRecord/{id}",
     *     tags={"PDS Office Setup"},
     *     summary="In-active Office Mgt Record",
     *     description="In-active Specific Office Mgt Record With Valid ID",
     *     operationId="inactiveOfficeMgtRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, In-active Office Mgt Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function inactiveOfficeMgtRecord($id)
    {
        try {
            $officeMgtInfo =  Office::find($id);

            if (!($officeMgtInfo === null)) {
                $officeMgtInfo = Office::where('id', '=', $id)->update(['status' => 2]);
                return response()->json([
                    'status'  => true,
                    'message' => "Inactived Office Mgt Successfully",
                    'errors'  => null,
                    'data'    => $officeMgtInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Office Mgt Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/activeOfficeMgtRecord/{id}",
     *     tags={"PDS Office Setup"},
     *     summary="Active Office Mgt Record",
     *     description="Active Specific Office Mgt Record With Valid ID",
     *     operationId="activeOfficeMgtRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Active Office Mgt Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function activeOfficeMgtRecord($id)
    {
        try {
            $officeMgtInfo = Office::find($id);

            if (!($officeMgtInfo === null)) {
                $officeMgtInfo = Office::where('id', '=', $id)->update(['status' => 1]);
                return response()->json([
                    'status'  => true,
                    'message' => "Actived Office Mgt Record Successfully",
                    'errors'  => null,
                    'data'    => $officeMgtInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Office Mgt Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     * tags={"PDS Office Setup"},
     * path="/pds-backend/api/specificOfficeSetup/{id}",
     * operationId="specificOfficeSetup",
     * summary="Specific Office Setup",
     * description="Specific Office Setup",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function specificOfficeSetup(Request $request)
    {
        try {
            $specificOfficeSetup = Office::findOrFail($request->id);
            return response()->json([
                'status' => 'success',
                'data' => $specificOfficeSetup,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }
}
