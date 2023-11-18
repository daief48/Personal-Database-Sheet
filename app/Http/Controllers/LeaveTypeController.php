<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveType;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;
use Validator;


class LeaveTypeController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp)
    {
        //$this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }

    /**
     * @OA\Get(
     * tags={"PDS Leave Type Setup"},
     * path= "/pds-backend/api/getLeaveType",
     * operationId="getLeaveType",
     * summary="Leave Type List",
     * description="Total Leave Type List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getLeaveType()
    {
        try {

            $getLeaveType = LeaveType::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'list' => $getLeaveType,
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
     * tags={"PDS Leave Type Setup"},
     * path="/pds-backend/api/addLeaveType",
     * operationId="addLeaveType",
     * summary="Add New Leave Type",
     * description="Add New Leave Type",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *                @OA\Property(property="days", type="text"),
     *                @OA\Property(property="leave_type", type="text"),
     *               @OA\Property(property="status", type="text"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Added Leave Type Setup Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */



    public function addLeaveType(Request $request)
    {
        try {

            $rules = [
                'leave_type' => 'required',
                'days' => 'required',
                'status' => 'required',
                // Add validation rules for other fields here
            ];

            $messages = [
                'leave_type.required' => 'The leave_type field is required',
                'days.required' => 'The days field is required',
                'status.required' => 'The status field is required',
                // Add custom error messages for other fields if needed
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $leaveType = LeaveType::create([
                'leave_type' => $request->leave_type,
                'days' => $request->days,
                'status' => $request->status,
            ]);

            return response()->json([
                'status'  => true,
                'message' => "Leave Type Created Successfully",
                'errors'  => null,
                'data'    => $leaveType,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Put(
     * tags={"PDS Leave Type Setup"},
     * path="/pds-backend/api/updateLeaveType/{id}",
     * operationId="updateLeaveType",
     * summary="Update Leave Type Setup",
     * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     * @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="leave_type", type="text", example="xyz"),
     *              @OA\Property(property="days", type="text", example="10"),
     *              @OA\Property(property="status", type="text", example=0),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Leave Type Setup Update Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */


    public function updateLeaveType(Request $request, $id)
    {

        try {
            $rules = [

                'leave_type' => 'required',
                'days' => 'required',
                'status' => 'required',
                // Add validation rules for other fields here
            ];

            $messages = [

                'leave_type.required' => 'The leave_type field is required',
                'days.required' => 'The days field is required',
                'status.required' => 'The status field is required',
                // Add custom error messages for other fields if needed
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $leaveType = LeaveType::findOrFail($id);
            $leaveType->leave_type = $request->leave_type;
            $leaveType->days = $request->days;
            $leaveType->status = $request->status;
            $leaveType->save();

            return response()->json([
                'status'  => true,
                'message' => "Leave Type Updated Successfully",
                'errors'  => null,
                'data'    => $leaveType,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Delete(
     *     path="/pds-backend/api/deleteLeaveType/{id}",
     *     tags={"PDS Leave Type Setup"},
     *     summary="Delete Leave Type Record",
     *     description="Delete Leave Type Record With Valid ID",
     *     operationId="deleteLeaveType",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Delete Leave Type Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    /**
     * @OA\Delete(
     *     path="/pds-backend/api/deleteLeaveType/{id}",
     *     tags={"PDS Leave Type Setup"},
     *     summary="Delete Leave Type Record",
     *     description="Delete Leave Type Record With Valid ID",
     *     operationId="deleteLeaveType",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Delete Leave Type Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function deleteLeaveType($id)
    {
        try {
            $leaveType = LeaveType::find($id);
            $leaveData = Leave::where('leave_type', '=', $id)->count();
            if ($leaveData === 0) {
                $leaveType->delete();
                return response()->json([
                    'status' => true,
                    'message' => "Department Record Deleted Successfully",
                    'errors' => null,
                    'data' => $leaveType,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Department Record cannot be deleted. Used this data in another module.",
                    'errors' => null,
                    'data' => $leaveType,
                ], 400);
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/activeLeaveTypeRecord/{id}",
     *     tags={"PDS Leave Type Setup"},
     *     summary="Active Leave Type Record",
     *     description="Active Specific Leave Type Record With Valid ID",
     *     operationId="activeLeaveTypeRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Active Leave Type Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function activeLeaveTypeRecord($id)
    {
        try {
            $leaveTypeInfo = LeaveType::find($id);

            if (!($leaveTypeInfo === null)) {
                $leaveTypeInfo = LeaveType::where('id', '=', $id)->update(['status' => 1]);
                return response()->json([
                    'status'  => true,
                    'message' => "Actived Leave Type Record Successfully",
                    'errors'  => null,
                    'data'    => $leaveTypeInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Leave Type Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/inactiveLeaveTypeRecord/{id}",
     *     tags={"PDS Leave Type Setup"},
     *     summary="In-active Leave Type Record",
     *     description="In-active Specific Leave Type Record With Valid ID",
     *     operationId="inactiveLeaveTypeRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, In-active Leave Type Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function inactiveLeaveTypeRecord($id)
    {
        try {
            $leaveTypeInfo =  LeaveType::find($id);

            if (!($leaveTypeInfo === null)) {
                $leaveTypeInfo = LeaveType::where('id', '=', $id)->update(['status' => 2]);
                return response()->json([
                    'status'  => true,
                    'message' => "Inactived Leave Type  Record Successfully",
                    'errors'  => null,
                    'data'    => $leaveTypeInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Leave Type Record Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Get(
     * tags={"PDS Leave Type Setup"},
     * path="/pds-backend/api/specificLeaveType/{id}",
     * operationId="specificLeaveType",
     * summary="Specific Leave Type Info",
     * description="Specific Leave Type Info",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function specificLeaveType(Request $request)
    {
        try {
            $specificLeaveType = LeaveType::findOrFail($request->id);
            return response()->json([
                'status' => 'success',
                'data' => $specificLeaveType,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }
}
