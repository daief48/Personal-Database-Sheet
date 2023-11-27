<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transfer;
use App\Repositories\ResponseRepository;
use Validator;
use Illuminate\Http\Response;
use File;
use App\Models\Employee;


class TransferController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp)
    {
        //$this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }

    /**
     * @OA\Get(
     * tags={"PDS User Transfer"},
     * path= "/pds-backend/api/getTransferList",
     * operationId="getTransferList",
     * summary="Transfer List",
     * description="Total Transfer List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getTransferList()
    {
        try {



            $getTransferList = Transfer::leftJoin('transfer_types', 'transfers.transfer_type', '=', 'transfer_types.id')
                ->leftJoin('designations as to_designation', 'transfers.to_designation', '=', 'to_designation.id')
                ->leftJoin('designations as from_designation', 'transfers.from_designation', '=', 'from_designation.id')
                ->leftJoin('departments as to_department', 'transfers.to_department', '=', 'to_department.id')
                ->leftJoin('departments as from_department', 'transfers.from_department', '=', 'from_department.id')
                ->leftJoin('offices as to_office', 'transfers.to_office', '=', 'to_office.id')
                ->leftJoin('offices as from_office', 'transfers.from_office', '=', 'from_office.id')
                ->leftJoin('employees', 'employees.id', '=', 'transfers.employee_id')
                ->select(
                    // 'transfers.*',
                    'transfers.id',
                    'employees.name as employee_name',
                    'transfers.transfer_order',
                    'transfer_types.title as t_type',
                    'transfers.transfer_order_number',
                    'to_office.office_name as to_office',
                    'from_office.office_name as from_office',
                    'to_department.dept_name as to_department',
                    'from_department.dept_name as from_department',
                    'to_designation.designation_name as to_designation',
                    'from_designation.designation_name as from_designation',
                    'transfers.transfer_date',
                    'transfers.join_date',
                    'transfers.transfer_date',
                    'transfers.transfer_letter',
                    'transfers.status',
                );

            $userRole = Auth::user()->role_id;

            if ($userRole == 1) {
                $getTransferList = $getTransferList->get();
            } else {
                $employeeInfo = Employee::where('user_id', Auth::user()->id)->first();
                $getTransferList = $getTransferList->where('transfers.employee_id', $employeeInfo->id)->get();
            }
            return response()->json([

                'data' => $getTransferList,
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
     * tags={"PDS User Transfer"},
     * path="/pds-backend/api/addTransferRecord",
     * operationId="addTransferRecord",
     * summary="Add New Transfer Record",
     * description="Add New New Transfer Record",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *                @OA\Property(property="employee_id", type="integer",example=1),
     *               @OA\Property(property="to_office", type="text"),
     *                @OA\Property(property="from_office", type="text"),
     *               @OA\Property(property="to_department", type="text"),
     *               @OA\Property(property="from_department", type="text"),
     *                @OA\Property(property="to_designation", type="text"),
     *               @OA\Property(property="from_designation", type="text"),
     *               @OA\Property(property="transfer_order", type="text"),
     *                @OA\Property(property="transfer_order_number", type="text"),
     *               @OA\Property(property="transfer_type", type="text"),
     *               @OA\Property(property="transfer_date", type="date"),
     *               @OA\Property(property="join_date", type="date"),
     *               @OA\Property(property="transfer_letter", type="text"),
     *               @OA\Property(property="status", type="text"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Added  Transfer Record Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function addTransferRecord(Request $request)
    {
        try {
            $rules = [

                'employee_id' => 'required',
                'transfer_type' => 'required',
                'transfer_order' => 'required',
                'transfer_order_number' => 'required',
                'to_office' => 'required',
                'from_office' => 'required',
                'to_department' => 'required',
                'from_department' => 'required',
                'to_designation' => 'required',
                'from_designation' => 'required',
                'transfer_date' => 'required',
                'join_date' => 'required',
                'transfer_letter' => 'required',
                // Add validation rules for other fields here
            ];

            $messages = [

                'employee_id.required' => 'The employee_id field is required',
                'transfer_type.required' => 'The transfer_type field is required',
                'transfer_order.required' => 'The transfer_order field is required',
                'transfer_order_number.required' => 'The transfer_order_number field is required',
                'to_office.required' => ' The to_office field is required',
                'from_office.required' => 'The from_office field is required',
                'to_department.required' => 'The to_department field is required',
                'from_department.required' => 'The from_department field is required',
                'to_designation.required' => 'The to_designation field is required',
                'from_designation.required' => 'The from_designation field is required',
                'transfer_date.required' => 'The transfer_date field is required',
                'join_date.unique' => 'This Join Date',
                'transfer_letter.required' => 'The Transfer Letterfield is required',
                // Add custom error messages for other fields if needed
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
          
            if ($request->file('transfer_letter')) {
                $file = $request->file('transfer_letter');
                $file_name = $request->file('transfer_letter')->getClientOriginalName();
                $image_ext = $request->file('transfer_letter')->getClientOriginalExtension();
                $fileNameToStore = 'transfer_letter' . time() . '.' . $image_ext;
                $destinationPath = public_path() . "/transferLetters/" . $fileNameToStore;
                $contents = file_get_contents($file);
                File::put($destinationPath, $contents);
                // $target->curriculum_vitae = $fileNameToStore;
            }

            $addTransfer = Transfer::create([

                'employee_id' => $request->employee_id,
                'transfer_type' => $request->transfer_type,
                'transfer_order' => $request->transfer_order,
                'transfer_order_number' => $request->transfer_order_number,
                'to_office' => $request->to_office,
                'from_office' => $request->from_office,
                'to_department' => $request->to_department,
                'from_department' => $request->from_department,
                'to_designation' => $request->to_designation,
                'from_designation' => $request->from_designation,
                'transfer_date' => $request->transfer_date,
                'join_date' => $request->join_date,
                'transfer_letter' => $fileNameToStore,
                'status' => $request->status ?? 0,
            ]);
            return $this->responseRepository->ResponseSuccess($addTransfer, 'Transfer Record Added Successfully !');
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Post( 
     * tags={"PDS User Transfer"},
     * path="/pds-backend/api/updateTransferRecord/{id}",
     * operationId="updateTransferRecord",
     * summary="Update Transfer Record",
     * description="Update Transfer Record",
     * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     * @OA\RequestBody(
     *      @OA\JsonContent(
     *          type="object",
     *          @OA\Property(property="employee_id", type="integer", example=1),
     *          @OA\Property(property="to_office", type="text", example=1),
     *          @OA\Property(property="from_office", type="text", example=1),
     *          @OA\Property(property="to_department", type="text", example=1),
     *          @OA\Property(property="from_department", type="text", example=1),
     *          @OA\Property(property="to_designation", type="text", example=1),
     *          @OA\Property(property="from_designation", type="text", example=1),
     *          @OA\Property(property="transfer_order", type="text", example="Order123"),
     *          @OA\Property(property="transfer_order_number", type="text", example="1204"),
     *          @OA\Property(property="transfer_type", type="text", example=12),
     *          @OA\Property(property="transfer_date", type="date", example="2023-10-11"),
     *          @OA\Property(property="join_date", type="date", example="2023-10-11"),
     *          @OA\Property(property="transfer_letter", type="text", example="letter.pdf"),
     *          @OA\Property(property="status", type="text", example=1),
     *      ),
     *    ),
     * @OA\Response(
     *      response=200,
     *      description="Updated Transfer Record Successfully",
     *      @OA\JsonContent()
     *   ),
     * @OA\Response(response=400, description="Bad request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function updateTransferRecord(Request $request, $id)
    {
        try {
            $rules = [
                'employee_id' => 'required',
                'transfer_type' => 'required',
                'transfer_order' => 'required',
                'transfer_order_number' => 'required',
                'to_office' => 'required',
                'from_office' => 'required',
                'to_department' => 'required',
                'from_department' => 'required',
                'to_designation' => 'required',
                'from_designation' => 'required',
                'transfer_date' => 'required',
                'join_date' => 'required',
                'transfer_letter' => 'required',
            ];

            $messages = [
                'employee_id.required' => 'The employee_id field is required',
                'transfer_type.required' => 'The transfer_type field is required',
                'transfer_order.required' => 'The transfer_order field is required',
                'transfer_order_number.required' => 'The transfer_order_number field is required',
                'to_office.required' => ' The to_office field is required',
                'from_office.required' => 'The from_office field is required',
                'to_department.required' => 'The to_department field is required',
                'from_department.required' => 'The from_department field is required',
                'to_designation.required' => 'The to_designation field is required',
                'from_designation.required' => 'The from_designation field is required',
                'transfer_date.required' => 'The transfer_date field is required',
                'join_date.required' => 'The join_date field is required',
                'transfer_letter.required' => 'The transfer_letter field is required',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $target = Transfer::findOrFail($id);

            if ($request->file('transfer_letter')) {
                $file = $request->file('transfer_letter');
                $file_name = $request->file('transfer_letter')->getClientOriginalName();
                $file_ext = $request->file('transfer_letter')->getClientOriginalExtension();
                $fileNameToStore = 'transfer_letter' . time() . '.' . $file_ext;
                $destinationPath = public_path() . "/transferLetters/" . $fileNameToStore;
                $contents = file_get_contents($file);
                File::put($destinationPath, $contents);

                $pFile = public_path() . "/transferLetters/" .  $target->transfer_letter;

                if (file_exists($pFile)) {
                    File::delete($pFile);
                }
            }

            $target->update([
                'employee_id' => $request->employee_id,
                'transfer_type' => $request->transfer_type,
                'transfer_order' => $request->transfer_order,
                'transfer_order_number' => $request->transfer_order_number,
                'to_office' => $request->to_office,
                'from_office' => $request->from_office,
                'to_department' => $request->to_department,
                'from_department' => $request->from_department,
                'to_designation' => $request->to_designation,
                'from_designation' => $request->from_designation,
                'transfer_date' => $request->transfer_date,
                'join_date' => $request->join_date,
                'transfer_letter' => $fileNameToStore,
                'status' => $request->status ?? 0,
            ]);

            return $this->responseRepository->ResponseSuccess($target, 'Transfer Record Updated Successfully !');
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }




    /**
     * @OA\Delete(
     *     path="/pds-backend/api/deleteTransferRecord/{id}",
     *     tags={"PDS User Transfer"},
     *     summary="Delete Transfer Record",
     *     description="Delete  Transfer Record With Valid ID",
     *     operationId="deleteTransferRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Delete Album" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function deleteTransferRecord($id)
    {
        try {
            $transferRecord =  Transfer::findOrFail($id);
            $transferRecord->delete();

            return response()->json([
                'status'  => true,
                'message' => "Transfer Record deleted successfully",
                'errors'  => null,
                'data'    => $transferRecord,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Patch(
     *     path="/pds-backend/api/activeTransferRecord/{id}",
     *     tags={"PDS User Transfer"},
     *     summary="Active Transfer Record",
     *     description="Active Specific Transfer Record With Valid ID",
     *     operationId="activeTransferRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Active Album" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function activeTransferRecord($id)
    {
        try {
            $transferInfo =  Transfer::find($id);

            if (!($transferInfo === null)) {
                $transferInfo = Transfer::where('id', '=', $id)->update(['status' => 1]);
                return response()->json([
                    'status'  => true,
                    'message' => "Actived Transfer Record Successfully",
                    'errors'  => null,
                    'data'    => $transferInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Transfer Record Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/inactiveTransferRecord/{id}",
     *     tags={"PDS User Transfer"},
     *     summary="In-active Transfer Record",
     *     description="In-active Specific Al Transfer Recordbum With Valid ID",
     *     operationId="inactiveTransferRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, In-active Album" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function inactiveTransferRecord($id)
    {
        try {
            $transferInfo =  Transfer::find($id);

            if (!($transferInfo === null)) {
                $transferInfo = Transfer::where('id', '=', $id)->update(['status' => 2]);
                return response()->json([
                    'status'  => true,
                    'message' => "Transfer Record In-actived Successfully",
                    'errors'  => null,
                    'data'    => $transferInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Transfer Record Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     * tags={"PDS User Transfer"},
     * path="/pds-backend/api/specificUserTransferRecord/{id}",
     * operationId="specificUserTransferRecord",
     * summary="Get Specific User Transfer Record",
     * description="",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function specificUserTransferRecord(Request $request)
    {
        try {
            $specificUserTransferRecord = Transfer::findOrFail($request->id);
            return response()->json([
                'status' => 'success',
                'data' => $specificUserTransferRecord,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }

    /**
     * @OA\Get(
     * tags={"PDS User Transfer"},
     * path="/pds-backend/api/specificUserTransferRecordByEmployeeId/{employee_id}",
     * operationId="specificUserTransferRecordByEmployeeId",
     * summary="Get Specific User Transfer Record",
     * description="",
     * @OA\Parameter(name="employee_id", description="employee_id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function specificUserTransferRecordByEmployeeId(Request $request)
    {
        try {
            $getTransferList = Transfer::leftJoin('transfer_types', 'transfers.transfer_type', '=', 'transfer_types.id')
                ->leftJoin('designations as to_designation', 'transfers.to_designation', '=', 'to_designation.id')
                ->leftJoin('designations as from_designation', 'transfers.from_designation', '=', 'from_designation.id')
                ->leftJoin('departments as to_department', 'transfers.to_department', '=', 'to_department.id')
                ->leftJoin('departments as from_department', 'transfers.from_department', '=', 'from_department.id')
                ->leftJoin('offices as to_office', 'transfers.to_office', '=', 'to_office.id')
                ->leftJoin('offices as from_office', 'transfers.from_office', '=', 'from_office.id')
                ->leftJoin('employees', 'employees.id', '=', 'transfers.employee_id')
                ->select(
                    'transfers.employee_id',
                    'transfers.id',
                    'employees.name as employee_name',
                    'transfers.transfer_order',
                    'transfer_types.title as t_type',
                    'transfers.transfer_order_number',
                    'to_office.office_name as to_office',
                    'from_office.office_name as from_office',
                    'to_department.dept_name as to_department',
                    'from_department.dept_name as from_department',
                    'to_designation.designation_name as to_designation',
                    'from_designation.designation_name as from_designation',
                    'transfers.transfer_date',
                    'transfers.join_date',
                    'transfers.transfer_date',
                    'transfers.transfer_letter',
                    'transfers.status',
                )->where('transfers.employee_id', $request->employee_id)->get();

            // $getTransferList = $getTransferList->where('employee_id', $request->employee_id);
            // dd($getTransferList);
            // exit;

            return response()->json([
                'status' => 'success',
                'data' => $getTransferList,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
