<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transfer;
use App\Repositories\ResponseRepository;
use Validator;
use Illuminate\Http\Response;
use File;


class TransferController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp,)
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
                ->leftJoin('designations', 'transfers.designation', '=', 'designations.id')
                ->leftJoin('departments', 'transfers.department', '=', 'departments.id')
                ->leftJoin('offices', 'transfers.to_office', '=', 'offices.id')
                ->leftJoin('employees', 'employees.id', '=', 'transfers.employee_id')
                ->select(
                    'transfer_types.title as t_type',
                    'transfers.transfer_order_number',
                    'offices.office_name as to_office',
                    'transfers.from_office',
                    'departments.dept_name as dept_name',
                    'designations.designation_name as designation',
                    'transfers.transfer_date',
                    'transfers.join_date',
                    'transfers.transfer_letter'
                )
                ->get();

            return response()->json([

                'data' => $getTransferList,
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
     *               @OA\Property(property="to_office", type="text"),
     *                @OA\Property(property="from_office", type="text"),
     *               @OA\Property(property="department", type="text"),
     *               @OA\Property(property="designation", type="text"),
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

                'transfer_type' => 'required',
                'transfer_order' => 'required',
                'transfer_order_number' => 'required',
                'to_office' => 'required',
                'from_office' => 'required',
                'department' => 'required',
                'designation' => 'required',
                'transfer_date' => 'required',
                'join_date' => 'required',
                'transfer_letter' => 'required',
                // Add validation rules for other fields here
            ];

            $messages = [

                'transfer_type.required' => 'The transfer_type field is required',
                'transfer_order.required' => 'The transfer_order field is required',
                'transfer_order_number.required' => 'The transfer_order_number field is required',
                'to_office.required' => ' The to_office field is required',
                'from_office.required' => 'The from_office field is required',
                'department.required' => 'The department field is required',
                'designation.required' => 'The designation field is required',
                'transfer_date.required' => 'The transfer_date field is required',
                'join_date.unique' => 'This Join Date',
                'transfer_letter.required' => 'The Transfer Letterfield is required',
                // Add custom error messages for other fields if needed
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }


            $addTransfer = Transfer::create([

                'transfer_type' => $request->transfer_type,
                'transfer_order' => $request->transfer_order,
                'transfer_order_number' => $request->transfer_order_number,
                'to_office' => $request->to_office,
                'from_office' => $request->from_office,
                'department' => $request->department,
                'designation' => $request->designation,
                'transfer_date' => $request->transfer_date,
                'join_date' => $request->join_date,
                'transfer_letter' => $request->transfer_letter,
                'status' => $request->status,
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
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *               
     *               @OA\Property(property="to_office", type="text",example="Dhaka"),
     *               @OA\Property(property="from_office", type="text",example="Mymensingh"),
     *               @OA\Property(property="department", type="text",example="3"),
     *               @OA\Property(property="designation", type="text",example="23"),
     *               @OA\Property(property="transfer_order", type="text",example="23"),
     *               @OA\Property(property="transfer_order_number", type="text",example="1204"),
     *               @OA\Property(property="transfer_type", type="text",example="2"),
     *               @OA\Property(property="transfer_date", type="date",example="2023-10-11"),
     *               @OA\Property(property="join_date", type="date",example="2023-10-11"),
     *               @OA\Property(property="transfer_letter", type="text",example="ghit.pdf"),
     *               @OA\Property(property="status", type="text",example="0"),
     *           
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

    public function updateTransferRecord(Request $request, $id)
    {

        try {

            $rules = [

                'transfer_type' => 'required',
                'transfer_order' => 'required',
                'transfer_order_number' => 'required',
                'to_office' => 'required',
                'from_office' => 'required',
                'department' => 'required',
                'designation' => 'required',
                'transfer_date' => 'required',
                'join_date' => 'required',
                'transfer_letter' => 'required',
                // Add validation rules for other fields here
            ];

            $messages = [

                'transfer_type.required' => 'The transfer_type field is required',
                'transfer_order.required' => 'The transfer_order field is required',
                'transfer_order_number.required' => 'The transfer_order_number field is required',
                'to_office.required' => ' The to_office field is required',
                'from_office.required' => 'The from_office field is required',
                'department.required' => 'The department field is required',
                'designation.required' => 'The designation field is required',
                'transfer_date.required' => 'The transfer_date field is required',
                'join_date.unique' => 'This Join Date',
                'transfer_letter.required' => 'The Transfer Letterfield is required',
                // Add custom error messages for other fields if needed
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                // return redirect()->back()->withErrors($validator)->withInput();
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $target = Transfer::findOrFail($id);
            $transferRecord = $target->transfer_letter;

            // if(!empty($request->thumbnail)){
            //     if (File::exists(public_path('/uploads/images/album_thumbnail/'.$thumbnail))) {
            //         File::delete(public_path('/uploads/images/album_thumbnail/'.$thumbnail));
            //     }

            //     $fileName = 'photo-'.uniqid().'-'.date("Y-M-D").".png";
            //     Image::make($request->thumbnail)->resize(300, null, function ($constraint) {
            //         $constraint->aspectRatio();
            //     })->save(public_path('/uploads/images/album_thumbnail/'.$fileName));
            //     $thumbnail = $fileName;
            // }

            $target->transfer_type = $request->transfer_type;
            $target->transfer_order = $request->transfer_order;
            $target->transfer_order_number = $request->transfer_order_number;
            $target->to_office = $request->to_office;
            $target->from_office = $request->from_office;
            $target->department = $request->department;
            $target->designation = $request->designation;
            $target->transfer_date = $request->transfer_date;
            $target->join_date = $request->join_date;
            $target->transfer_letter = $transferRecord;
            $target->status = $request->status;
            $target->save();


            return $this->responseRepository->ResponseSuccess($target, 'Transfer Record Change Successfully !');
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
                $transferInfo = Transfer::where('id', '=', $id)->update(['status' => 0]);
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
}
