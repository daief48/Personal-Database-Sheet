<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Acr;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;


class AcrController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp,)
    {
        //$this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }

    /**
     * @OA\Get(
     * tags={"PDS Annual Confidential Report Management"},
     * path= "/pds-backend/api/getAcr",
     * operationId="getAcr",
     * summary="PDS Annual Confidential Report List",
     * description="Total Leave Type List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

     public function getAcr(){
        try {

            $getAcr = Acr::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'list' => $getAcr,
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
    * tags={"PDS Annual Confidential Report Management"},
    * path="/pds-backend/api/addacr",
    * operationId="addacr",
    * summary="Add New ACR Mgt",
    * description="Add New ACR Mgt",
    *     @OA\RequestBody(
    *         @OA\JsonContent(),
    *         @OA\MediaType(
    *            mediaType="multipart/form-data",
    *            @OA\Schema(
    *               type="object",
    *               required={},
    *               @OA\Property(property="emp_id", type="text"),
    *               @OA\Property(property="emp_name", type="date"),
    *               @OA\Property(property="designation", type="date"),
    *               @OA\Property(property="department", type="text"),
    *               @OA\Property(property="office_name", type="text"),
    *               @OA\Property(property="acr_year", type="text"),
    *               @OA\Property(property="score", type="text"),
    *               @OA\Property(property="file", type="text"),
    *               @OA\Property(property="remarks", type="text"),
    *               @OA\Property(property="status", type="text"),
    *            ),
    *        ),
    *    ),
    *      @OA\Response(
    *          response=200,
    *          description="Added ACR Mgt Setup Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * ),
    *     security={{"bearer_token":{}}}
    */

    public function addAcr(Request $request){
        try {

            $acrInfo = Acr::create([
                'emp_id' => $request->emp_id,
                'emp_name' => $request->emp_name,
                'designation' => $request->designation,
                'department' => $request->department,
                'office_name' => $request->office_name,
                'acr_year' => $request->acr_year,
                'score' => $request->score,
                'file' => $request->file,
                'remarks' => $request->remarks,
                'status' => $request->status,
            ]);

            return response()->json([
                'status'  => true,
                'message' => "ACR Mgt Created Successfully",
                'errors'  => null,
                'data'    => $acrInfo,
            ], 200);

        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
    * @OA\Put(
    * tags={"PDS Annual Confidential Report Management"},
    * path="/pds-backend/api/updateAcrMgt/{id}",
    * operationId="updateAcrMgt",
    * summary="Update ACR Mgt Setup",
    * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
    * @OA\RequestBody(
    *          @OA\JsonContent(
    *              type="object",
    *              @OA\Property(property="emp_id", type="text", example="2"),
    *              @OA\Property(property="emp_name", type="date", example="Yeasin"),
    *              @OA\Property(property="designation", type="date", example="2"),
    *              @OA\Property(property="department", type="text", example="2"),
    *              @OA\Property(property="office_name", type="text", example="2"),
    *              @OA\Property(property="acr_year", type="text", example="2023"),
    *              @OA\Property(property="score", type="text", example="4"),
    *              @OA\Property(property="file", type="text", example="file_update"),
    *              @OA\Property(property="remarks", type="text", example="remark_update"),
    *              @OA\Property(property="status", type="text", example=0),
    *          ),
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="ACR Mgt Setup Update Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * ),
    *     security={{"bearer_token":{}}}
    */

    public function updateAcrMgt(Request $request, $id) {

        try {

            $acrInfo = Acr::findOrFail($id);
            $acrInfo->emp_id = $request->emp_id;
            $acrInfo->emp_name = $request->emp_name;
            $acrInfo->designation = $request->designation;
            $acrInfo->department = $request->department;
            $acrInfo->office_name = $request->office_name;
            $acrInfo->acr_year = $request->acr_year;
            $acrInfo->score = $request->score;
            $acrInfo->file = $request->file;
            $acrInfo->remarks = $request->remarks;
            $acrInfo->status = $request->status;
            $acrInfo->save();

            return response()->json([
                'status'  => true,
                'message' => "ACR Mgt Updated Successfully",
                'errors'  => null,
                'data'    => $acrInfo,
            ], 200);

        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
    * @OA\Get(
    * tags={"PDS Annual Confidential Report Management"},
    * path="/pds-backend/api/specificAcrInfo/{id}",
    * operationId="specificAcrInfo",
    * summary="Specific Acr Info Detail",
    * description="",
    * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
    * @OA\Response(response=200, description="Success" ),
    * @OA\Response(response=400, description="Bad Request"),
    * @OA\Response(response=404, description="Resource Not Found"),
    * ),
    * security={{"bearer_token":{}}}
    */

    public function specificAcrInfo(Request $request){
        try {
            $specificAcrInfo = Acr::findOrFail($request->id);
            return response()->json([
                'status' => 'success',
                'data' => $specificAcrInfo,
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }


}