<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transfer;
use App\Repositories\ResponseRepository;
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

    public function getTransferList(){
        try {

            $getTransferList = Transfer::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'list' => $getTransferList,
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
     *               @OA\Property(property="department", type="text"),
     *               @OA\Property(property="designation", type="text"),
     *               @OA\Property(property="transfer_order", type="text"),
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
             $addTransfer = Transfer::create([
                 'to_office' => $request->to_office,
                 'department' => $request->department,
                 'designation' => $request->designation,
                 'transfer_order' => $request->transfer_order,
                 'transfer_type' =>$request->transfer_type,
                 'transfer_date' =>$request->transfer_date,
                 'join_date' =>$request->join_date,
                 'transfer_letter' =>$request->transfer_letter,
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
    * path="/pds-backend/api/updateTransferRecord",
    * operationId="updateTransferRecord",
    * summary="Update Transfer Record",
    * description="Update Transfer Record",
    *     @OA\RequestBody(
    *         @OA\JsonContent(),
    *         @OA\MediaType(
    *            mediaType="multipart/form-data",
    *            @OA\Schema(
    *               type="object",
    *               required={},
    *               @OA\Property(property="id", type="text"),
    *               @OA\Property(property="to_office", type="text"),
    *               @OA\Property(property="department", type="text"),
    *               @OA\Property(property="designation", type="text"),
    *               @OA\Property(property="transfer_order", type="text"),
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
    *          description="Updated Guest Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * ),
    *     security={{"bearer_token":{}}}
    */

    public function updateTransferRecord(Request $request)
    {

        try {

            $target = Transfer::find($request->id);
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

            $target->to_office = $request->to_office;
            $target->department = $request->department;
            $target->designation = $request->designation;
            $target->transfer_order = $request->transfer_order;
            $target->transfer_type = $request->transfer_type;
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
}