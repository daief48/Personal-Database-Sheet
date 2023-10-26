<?php

namespace App\Http\Controllers;

use App\Models\TransferType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\ResponseRepository;
use Validator;

class TransferTypeController extends Controller
{
    protected $responseRepository;
    public function __construct(ResponseRepository $rp,)
    {
        //$this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }
    /**
     * @OA\Get(
     * tags={"PDS Transfer Type Setup"},
     * path= "/pds-backend/api/transferType",
     * operationId="transferType",
     * summary="Transfer Type List",
     * description="Total Transfer Type List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */
    public function transferType()
    {
        try {

            $getransferType = TransferType::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'list' => $getransferType,
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
     * tags={"PDS Transfer Type Setup"},
     * path= "/pds-backend/api/addTransferType",
     * operationId="addTransferType",
     * summary="Transfer Type List",
     * description="Add New Transfer Type",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *               @OA\Property(property="employee_id", type="integer"),
     *                @OA\Property(property="title", type="text"),
     *                @OA\Property(property="status", type="integer"),

     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Added Transfer Type Setup Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */



    public function addTransferType(Request $request)
    {
        try {

            $rules = [

                'employee_id' => 'required',
                'title' => 'required',
                'status' => 'required',
                // Add validation rules for other fields here
            ];

            $messages = [

                'employee_id.required' => 'The employee_id field is required',
                'title.required' => 'The title field is required',
                'status.required' => 'The status field is required',
                // Add custom error messages for other fields if needed
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $TransferType = TransferType::create([
                'employee_id' => $request->employee_id,
                'title' => $request->title,
                'status' => $request->status,
            ]);

            return response()->json([
                'status'  => true,
                'message' => "Transfer Type Created Successfully",
                'errors'  => null,
                'data'    => $TransferType,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Put(
     * tags={"PDS Transfer Type Setup"},
     * path="/pds-backend/api/updateTransferType/{id}",
     * operationId="updateTransferType",
     * summary="Transfer Type List",
     * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     * @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="employee_id", type="integer",example=0),
     *              @OA\Property(property="title", type="text", example="General"),
     *              @OA\Property(property="status", type="text", example=0),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Transfer Type Setup Update Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */


    public function updateTransferType(Request $request, $id)
    {

        try {

            $rules = [

                'employee_id' => 'required',
                'title' => 'required',
                'status' => 'required',
                // Add validation rules for other fields here
            ];

            $messages = [

                'employee_id.required' => 'The employee_id field is required',
                'title.required' => 'The title field is required',
                'status.required' => 'The status field is required',
                // Add custom error messages for other fields if needed
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $TransferType = TransferType::findOrFail($id);
            $TransferType->employee_id = $request->employee_id;
            $TransferType->title = $request->title;
            $TransferType->status = $request->status;
            $TransferType->save();

            return response()->json([
                'status'  => true,
                'message' => "Transfer Type Updated Successfully",
                'errors'  => null,
                'data'    => $TransferType,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    /**
     * @OA\Delete(
     *     path="/pds-backend/api/deleteTransferType/{id}",
     *     tags={"PDS Transfer Type Setup"},
     *     summary="Delete TransferType Type Record",
     *     description="Delete TransferType Type Record With Valid ID",
     *     operationId="deleteTransferType",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Delete Transfer Type Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function deleteTransferType($id)
    {
        try {
            $transferType = TransferType::findOrFail($id);
            $transferType->delete();

            return response()->json([
                'status'  => true,
                'message' => "Transfer Type Record Deleted Successfully",
                'errors'  => null,
                'data'    => $transferType,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Patch(
     *     path="/pds-backend/api/activeTransferType/{id}",
     *     tags={"PDS Transfer Type Setup"},
     *     summary="Active TransferType Type Record",
     *     description="Active Specific TransferType Type Record With Valid ID",
     *     operationId="activeTransferType",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Active Transfer Type Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function activeTransferType($id)
    {
        try {
            $transferTypeInfo = TransferType::find($id);

            if (!($transferTypeInfo === null)) {
                $transferTypeInfo = TransferType::where('id', '=', $id)->update(['status' => 1]);
                return response()->json([
                    'status'  => true,
                    'message' => "Actived Transfer Type Record Successfully",
                    'errors'  => null,
                    'data'    => $transferTypeInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Transfer Type Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    /**
     * @OA\Patch(
     *     path="/pds-backend/api/inactiveTransferTypeRecord/{id}",
     *     tags={"PDS Transfer Type Setup"},
     *     summary="In-active Transfer Type Record",
     *     description="In-active Specific Transfer Type Record With Valid ID",
     *     operationId="inactiveTransferTypeRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, In-active Transfer Type Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function inactiveTransferTypeRecord($id)
    {
        try {
            $transferTypeInfo =  TransferType::find($id);

            if (!($transferTypeInfo === null)) {
                $transferTypeInfo = TransferType::where('id', '=', $id)->update(['status' => 0]);
                return response()->json([
                    'status'  => true,
                    'message' => "Inactived Transfer Type  Record Successfully",
                    'errors'  => null,
                    'data'    => $transferTypeInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Transfer Type Record Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Get(
     * tags={"PDS Transfer Type Setup"},
     * path="/pds-backend/api/specificTransferType/{id}",
     * operationId="specificTransferType",
     * summary="Specific Transfer Type Info",
     * description="Specific Transfer Type Info",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function specificTransferType(Request $request)
    {
        try {
            $specificTransferType = TransferType::findOrFail($request->id);
            return response()->json([
                'status' => 'success',
                'data' => $specificTransferType,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }
}
