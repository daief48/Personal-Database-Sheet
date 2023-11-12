<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations\Get;
use Validator;

class LeaveController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp)
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
            $employeeLeaveApplicationArrays = [];

            $takenLeaves = Leave::where('status', 1)
                ->groupBy('employee_id', 'leave_type')
                ->select('employee_id', 'leave_type', DB::raw('sum(day) as total_days'))
                ->get();
            // dd($takenLeaves);
            // exit;

            foreach ($takenLeaves as $takenLeave) {
                $employeeId = $takenLeave->employee_id;
                $leaveType = $takenLeave->leave_type;
                $totalDays = $takenLeave->total_days;
                $employeeLeaveApplicationArrays[$employeeId][$leaveType] = $totalDays;
            }

            // dd($employeeLeaveApplicationArrays);
            // exit;

            $getLeaveSetup = Leave::leftJoin('leave_types', 'leaves.leave_type', '=', 'leave_types.id')
                ->leftjoin('employees', 'leaves.employee_id', '=', 'employees.id')
                ->select(
                    'leave_types.days',
                    'leave_types.leave_type as leave_type_name',
                    'leaves.created_at',
                    'leaves.leave_type',
                    'leaves.from_date',
                    'leaves.to_date',
                    'leaves.day',
                    'leaves.id',
                    'leaves.employee_id',
                    'leaves.status',
                    'employees.name'
                )->get();

            $employeeLeaveArrays = [];

            foreach ($getLeaveSetup as $leaveSetup) {
                $leaveTypeId = $leaveSetup->leave_type;
                $availableDays = $leaveSetup->days;
                $employeeId = $leaveSetup->employee_id;

                if (array_key_exists($employeeId, $employeeLeaveApplicationArrays) && array_key_exists($leaveTypeId, $employeeLeaveApplicationArrays[$employeeId])) {

                    $daysTaken = $employeeLeaveApplicationArrays[$employeeId][$leaveTypeId];
                    $remainingDays = $availableDays - $daysTaken;
                } else {

                    $remainingDays = $availableDays;
                }

                $employeeLeaveArrays[] = [
                    'leave_type_name' => $leaveSetup->leave_type_name,
                    'remaining_days' => $remainingDays,
                    'created_at' => $leaveSetup->created_at,
                    'leave_type' => $leaveSetup->leave_type,
                    'from_date' => $leaveSetup->from_date,
                    'to_date' => $leaveSetup->to_date,
                    'day' => $leaveSetup->day,
                    'id' => $leaveSetup->id,
                    'employee_id' => $leaveSetup->employee_id,
                    'employee_name' => $leaveSetup->name,
                    'status' => $leaveSetup->status,
                ];
            }
            // dd($combinedData);
            // exit;



            return response()->json([
                'status' => 'success',
                'list' => $employeeLeaveArrays,

            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Get(
     * tags={"PDS Leave Management"},
     * path= "/pds-backend/api/getLeaveByEmployeeId/{employee_id}",
     * operationId="getLeaveByEmployeeId",
     * summary="Leave Mgt List",
     * description="",
     * @OA\Parameter(name="employee_id", description="employee_id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getLeaveByEmployeeId(Request $request)
    {

        try {
            $employeeLeaveApplicationArrays = [];

            $takenLeaves = Leave::where('status', 1)
                ->where('employee_id', $request->employee_id)
                ->groupBy('employee_id', 'leave_type')
                ->select('employee_id', 'leave_type', DB::raw('sum(day) as total_days'))
                ->get();

            foreach ($takenLeaves as $takenLeave) {
                $employeeId = $takenLeave->employee_id;
                $leaveType = $takenLeave->leave_type;
                $totalDays = $takenLeave->total_days;
                $employeeLeaveApplicationArrays[$employeeId][$leaveType] = $totalDays;
            }

            // dd($employeeLeaveApplicationArrays);
            // exit;

            $getLeaveSetup = Leave::leftJoin('leave_types', 'leaves.leave_type', '=', 'leave_types.id')
                ->leftjoin('employees', 'leaves.employee_id', '=', 'employees.id')
                ->leftjoin('designations', 'employees.designation', '=', 'designations.id')

                ->select(
                    'leave_types.days',
                    'leave_types.leave_type as leave_type_name',
                    'leaves.created_at',
                    'leaves.leave_type',
                    'leaves.from_date',
                    'leaves.to_date',
                    'leaves.day',
                    'leaves.employee_id',
                    'leaves.status',
                    'employees.name',
                    'employees.mobile_number',
                    'employees.email',
                    'designations.designation_name',
                )
                ->where('leaves.status', 1)
                ->where('employee_id', $request->employee_id)
                ->get();

            $employeeLeaveArrays = [];

            foreach ($getLeaveSetup as $leaveSetup) {
                $leaveTypeId = $leaveSetup->leave_type;
                $availableDays = $leaveSetup->days;
                $employeeId = $leaveSetup->employee_id;
                $leavetype = $leaveSetup->leave_type_name;


                if (array_key_exists($employeeId, $employeeLeaveApplicationArrays) && array_key_exists($leaveTypeId, $employeeLeaveApplicationArrays[$employeeId])) {

                    $daysTaken = $employeeLeaveApplicationArrays[$employeeId][$leaveTypeId];
                    $remainingDays = $availableDays - $daysTaken;
                } else {

                    $remainingDays = $availableDays;
                }

                $employeeLeaveArrays[$leavetype] = [
                    'leave_type_name' => $leaveSetup->leave_type_name,
                    'total_days' => $leaveSetup->days,
                    'used' => $daysTaken,
                    'available' => $remainingDays,
                    'employee_id' => $leaveSetup->employee_id,
                    'status' => $leaveSetup->status,
                    'name' => $leaveSetup->name,
                    'mobile_number' => $leaveSetup->mobile_number,
                    'email' => $leaveSetup->email,
                    'designation_name' => $leaveSetup->designation_name,
                ];
            }
            // dd($employeeLeaveArrays);
            // exit;



            return response()->json([
                'status' => 'success',
                'list' => $employeeLeaveArrays,

            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
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
     *                 @OA\Property(property="employee_id", type="integer", example=1),
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
            'employee_id' => 'required',
            'leave_type' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'day' => 'required',
            'description' => 'required',

        ];

        $messages = [
            'employee_id.required' => 'The employee_id field is required',
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
                'employee_id' => $request->employee_id,
                'leave_type' => $request->leave_type,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'day' => $request->day,
                'description' => $request->description,
                'status' => $request->status ?? 0,
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
     * @OA\Post(
     * tags={"PDS Leave Management"},
     * path="/pds-backend/api/updateLeaveMgt/{id}",
     * operationId="updateLeaveMgt",
     * summary="Update Leave Mgt Setup",
     * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     * @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="employee_id", type="integer",example=1),
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
            'employee_id' => 'required',
            'leave_type' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'day' => 'required',
            'description' => 'required',



        ];

        $messages = [

            'employee_id.required' => 'The employee_id field is required',
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
            $leaveInfo->employee_id = $request->employee_id;
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
                $leaveMgtInfo = Leave::where('id', '=', $id)->update(['status' => 2]);
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

    /**
     * @OA\Get(
     *     tags={"PDS Leave Management"},
     *     path="/pds-backend/api/specificUserLeaveRecordByEmployeeId/{employee_id}",
     *     operationId="specificUserLeaveRecordByEmployeeId",
     *     summary="Get Specific User Training Record",
     *     description="",
     *     @OA\Parameter(
     *         name="employee_id",
     *         description="Employee ID",
     *         example=1,
     *         required=true,
     *         in="path",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Success"),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Not Found"),
     *     security={{"bearer_token": {}}}
     * )
     */
    public function specificUserLeaveRecordByEmployeeId(Request $request)
    {
        try {
            $getTrainingList = Leave::leftJoin('employees', 'employees.id', '=', 'leaves.employee_id')
                ->select('employees.id as employee_id', 'employees.name as employee_name', 'leaves.*')
                ->where('leaves.employee_id', $request->employee_id)
                ->get();

            return response()->json([
                'status' => 'success',
                'data' => $getTrainingList,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 404);
        }
    }
    /**
     * @OA\Get(
     * tags={"PDS Leave Management"},
     * path="/pds-backend/api/specificUserLeave/{id}",
     * operationId="specificUserLeave",
     * summary="Get Specific User Promotion Record",
     * description="",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function specificUserLeave(Request $request)
    {
        try {
            $specificUserLeave = Leave::findOrFail($request->id);
            return response()->json([
                'status' => 'success',
                'data' => $specificUserLeave,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }
}
