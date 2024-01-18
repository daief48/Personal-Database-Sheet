<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FreedomFighter;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;


class FreedomFighterController extends Controller

{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp)
    {
        //$this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }

    /**
     * @OA\Get(
     * tags={"PDS Freedom Fighter list"},
     * path= "/pds-backend/api/getFreedomFighter",
     * operationId="getFreedomFighter",
     * summary="PDS Annual Confidential Report List",
     * description="Total Leave Type List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getFreedomFighter()
    {
        try {

            $getFreedomFighter = FreedomFighter::leftjoin('employees', 'employees.id', '=', 'freedom_fighters.employee_id')
                ->leftjoin('departments', 'departments.id', '=', 'employees.department')
                ->leftjoin('designations', 'designations.id', '=', 'employees.designation')
                ->select(
                    'freedom_fighters.*',
                    'employees.name',
                    'departments.dept_name',
                    'designations.designation_name'
                )
                ->get();
            return response()->json([
                'status' => 'success',
                'list' => $getFreedomFighter,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }

    /**
     * @OA\Get(
     *     tags={"PDS Freedom Fighter list"},
     *     path="/pds-backend/api/getFreedomFighterByEmpId/{id}",
     *     operationId="getFreedomFighterByEmpId",
     *     summary="Get Freedom Fighter by ID",
     *     description="Retrieve information about a specific Freedom Fighter by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the Freedom Fighter",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Success", @OA\JsonContent()),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     security={{"bearer_token":{}}}
     * )
     */

    public function getFreedomFighterByEmpId($id)
    {
        try {
            $getFreedomFighter = FreedomFighter::where('freedom_fighters.employee_id','=',$id)
                ->first();

            

            if (!$getFreedomFighter) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Freedom Fighter not found.',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $getFreedomFighter,
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
     * tags={"PDS Freedom Fighter list"},
     * path="/pds-backend/api/addFreedomFighter",
     * operationId="addFreedomFighter",
     * summary="Add New Freedom Fighter",
     * description="Add New Freedom Fighter",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *               @OA\Property(property="employee_id", type="text"),
     *               @OA\Property(property="freedom_fighter_num", type="text"),
     *               @OA\Property(property="fighting_divi", type="text"),
     *                @OA\Property(property="Sector", type="text"),
     *               @OA\Property(property="status", type="text"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Added freedom_fighters Mgt Setup Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function addFreedomFighter(Request $request)
    {
        try {

            $addFreedomFighter = FreedomFighter::create([
                'employee_id' => $request->employee_id,
                'freedom_fighter_num' => $request->freedom_fighter_num,
                'Sector' => $request->Sector,
                'fighting_divi' => $request->fighting_divi,
                'status' => $request->status ?? 0,
            ]);

            return response()->json([
                'status'  => true,
                'message' => "AFreedom Fighter Created Successfully",
                'errors'  => null,
                'data'    => $addFreedomFighter,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Put(
     * tags={"PDS Freedom Fighter list"},
     * path="/pds-backend/api/updateFreedomFighter/{id}",
     * operationId="updateFreedomFighter",
     * summary="Update Freedom Fighter",
     * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     * @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="employee_id", type="text", example="2"),
     *              @OA\Property(property="freedom_fighter_num", type="date", example="1241434"),
     *              @OA\Property(property="fighting_divi", type="date", example="dhaka"),
     *               @OA\Property(property="Sector", type="date", example="dhaka"),
     *              @OA\Property(property="status", type="text", example=0),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Freedom Fighter Update Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function updateFreedomFighter(Request $request, $id)
    {

        try {

            $acrInfo = FreedomFighter::findOrFail($id);
            $acrInfo->employee_id = $request->employee_id;
            $acrInfo->freedom_fighter_num = $request->freedom_fighter_num;
            $acrInfo->fighting_divi = $request->fighting_divi;
            $acrInfo->Sector = $request->Sector;
            $acrInfo->status = $request->status;
            $acrInfo->save();

            return response()->json([
                'status'  => true,
                'message' => "Freedom Fighter Updated Successfully",
                'errors'  => null,
                'data'    => $acrInfo,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Delete(
     *      tags={"PDS Freedom Fighter list"},
     *     path="/pds-backend/api/deleteFreedomFighter/{id}",
     *     summary="Delete Transfer Record",
     *     description="Delete  Transfer Record With Valid ID",
     *     operationId="deleteFreedomFighter",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Delete Album" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function deleteFreedomFighter($id)
    {
        try {
            $FreedomFighter =  FreedomFighter::findOrFail($id);
            $FreedomFighter->delete();

            return response()->json([
                'status'  => true,
                'message' => "Transfer Record deleted successfully",
                'errors'  => null,
                'data'    => $FreedomFighter,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
