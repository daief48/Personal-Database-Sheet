<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Leave;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;

use Validator;

class LeaveController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp,)
    {
        //$this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }

    /**
     * @OA\Get(
     * tags={"PDS Leave Management"},
     * path= "/pds-backend/api/getLeaveMgt",
     * operationId="getLeaveMgt",
     * summary="Leave Mgt List",
     * description="Total Leave Mgt List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getLeaveMgt()
    {

        try {

            $getLeaveSetup = Leave::select(
                'created_at',
                'leave_type',
                'from_date',
                'to_date',
                'day',
            )->orderBy('id', 'desc')->get();

            return response()->json([
                'status' => 'success',
                'list' => $getLeaveSetup,
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
     * tags={"PDS Leave Management"},
     * path="/pds-backend/api/addLeaveMgt",
     * operationId="addLeaveMgt",
     * summary="Add New Leave Mgt",
     * description="Add New Leave Mgt",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *                @OA\Property(property="leave_type", type="text"),
     *               @OA\Property(property="from_date", type="date"),
     *               @OA\Property(property="to_date", type="date"),
     *               @OA\Property(property="day", type="text"),
     *               @OA\Property(property="description", type="text"),
     *               @OA\Property(property="status", type="text"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Added Leave Mgt Setup Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function addLeaveMgt(Request $request)
    {

        $rules = [
            'leave_type' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'day' => 'required',
            'description' => 'required',

        ];

        $messages = [
            'leave_type.required' => 'The leave_type field is required',
            'from_date.required' => 'The from_date field is required',
            'to_date.required' => 'The to_date field is required',
            'day.required' => 'The day field is required',
            'description.required' => 'The description field is required',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        try {

            $leaveInfo = Leave::create([
                'leave_type' => $request->leave_type,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'day' => $request->day,
                'description' => $request->description,
                'status' => $request->status,
            ]);

            return response()->json([
                'status'  => true,
                'message' => "Leave Mgt Created Successfully",
                'errors'  => null,
                'data'    => $leaveInfo,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Put(
     * tags={"PDS Leave Management"},
     * path="/pds-backend/api/updateLeaveMgt/{id}",
     * operationId="updateLeaveMgt",
     * summary="Update Leave Mgt Setup",
     * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     * @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="leave_type", type="text", example="2"),
     *              @OA\Property(property="from_date", type="date", example="2023-03-23"),
     *              @OA\Property(property="to_date", type="date", example="2023-03-23"),
     *              @OA\Property(property="day", type="text", example="2"),
     *              @OA\Property(property="description", type="text", example="good"),
     *              @OA\Property(property="status", type="text", example=0),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Leave Mgt Setup Update Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function updateLeaveMgt(Request $request, $id)
    {

        $rules = [
            'leave_type' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'day' => 'required',
            'description' => 'required',

        ];

        $messages = [
            'leave_type.required' => 'The leave_type field is required',
            'from_date.required' => 'The from_date field is required',
            'to_date.required' => 'The to_date field is required',
            'day.required' => 'The day field is required',
            'description.required' => 'The description field is required',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        try {

            $leaveInfo = Leave::findOrFail($id);
            $leaveInfo->leave_type = $request->leave_type;
            $leaveInfo->from_date = $request->from_date;
            $leaveInfo->to_date = $request->to_date;
            $leaveInfo->day = $request->day;
            $leaveInfo->description = $request->description;
            $leaveInfo->status = $request->status;
            $leaveInfo->save();

            return response()->json([
                'status'  => true,
                'message' => "Leave Mgt Updated Successfully",
                'errors'  => null,
                'data'    => $leaveInfo,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Delete(
     *     path="/pds-backend/api/deleteLeaveMgt/{id}",
     *     tags={"PDS Leave Management"},
     *     summary="Delete Leave Mgt Record",
     *     description="Delete Leave Mgt Record With Valid ID",
     *     operationId="deleteLeaveMgt",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Delete Leave Mgt Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function deleteLeaveMgt($id)
    {
        try {
            $leaveMgt =  Leave::findOrFail($id);
            $leaveMgt->delete();

            return response()->json([
                'status'  => true,
                'message' => "Leave Mgt Record Deleted Successfully",
                'errors'  => null,
                'data'    => $leaveMgt,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/inactiveLeaveMgtRecord/{id}",
     *     tags={"PDS Leave Management"},
     *     summary="In-active Leave Mgt Record",
     *     description="In-active Specific Leave Mgt Record With Valid ID",
     *     operationId="inactiveLeaveMgtRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, In-active Leave Mgt Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function inactiveLeaveMgtRecord($id)
    {
        try {
            $leaveMgtInfo =  Leave::find($id);

            if (!($leaveMgtInfo === null)) {
                $leaveMgtInfo = Leave::where('id', '=', $id)->update(['status' => 0]);
                return response()->json([
                    'status'  => true,
                    'message' => "Inactived Leave Mgt Successfully",
                    'errors'  => null,
                    'data'    => $leaveMgtInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Leave Mgt Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/activeLeaveMgtRecord/{id}",
     *     tags={"PDS Leave Management"},
     *     summary="Active Leave Mgt Record",
     *     description="Active Specific Office Mgt Record With Valid ID",
     *     operationId="activeLeaveMgtRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Active Leave Mgt Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function activeLeaveMgtRecord($id)
    {
        try {
            $leaveMgtInfo = Leave::find($id);

            if (!($leaveMgtInfo === null)) {
                $leaveMgtInfo = Leave::where('id', '=', $id)->update(['status' => 1]);
                return response()->json([
                    'status'  => true,
                    'message' => "Actived Leave Mgt Record Successfully",
                    'errors'  => null,
                    'data'    => $leaveMgtInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Leave Mgt Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
