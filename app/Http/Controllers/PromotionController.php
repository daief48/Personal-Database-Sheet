<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Promotion;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;
use Validator;
use File;


class PromotionController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp,)
    {
        //$this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }

    /**
     * @OA\Get(
     * tags={"PDS User Promotion"},
     * path= "/pds-backend/api/getPromotion",
     * operationId="getPromotion",
     * summary="Promotion List",
     * description="Total Promotion List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getPromotion()
    {
        try {

            $getPromotion = Promotion::select(
                'employee_id',
                'promotion_ref_number',
                'promoted_designation',
                'promotion_date',
                'description'

            )
                ->orderBy('id', 'desc')->get();
            // leftJoin('designations', 'promotion.promoted_designation', '=', 'designations.id')->select('designations.designation_name as designation')

            return response()->json([
                'status' => 'success',
                'list' => $getPromotion,
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
     * tags={"PDS User Promotion"},
     * path="/pds-backend/api/addPromotion",
     * operationId="addPromotion",
     * summary="Add New Promotion",
     * description="Add New Promotion",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *               @OA\Property(property="employee_id", type="integer",example=1),
     *               @OA\Property(property="promotion_ref_number", type="text"),
     *               @OA\Property(property="promoted_designation", type="text"),
     *               @OA\Property(property="promotion_date", type="date"),
     *               @OA\Property(property="status", type="text"),
     *               @OA\Property(property="description", type="text")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Added Promotion Record Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */



    public function addPromotion(Request $request)
    {
        try {
            $rules = [
                'employee_id' => 'required',
                'promotion_ref_number' => 'required',
                'promoted_designation' => 'required',
                'promotion_date' => 'required',
                'description' => 'required',

            ];

            $messages = [
                'employee_id.required' => 'The employee_id field is required',
                'promotion_ref_number.required' => 'The promotion_ref_number field is required',
                'promoted_designation.required' => 'The promoted_designation field is required',
                'promotion_date.required' => 'The promotion_date field is required',
                'description.required' => 'The description field is required',

            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }


            $promotion = Promotion::create([
                'employee_id' => $request->employee_id,
                'promotion_ref_number' => $request->promotion_ref_number,
                'promoted_designation' => $request->promoted_designation,
                'promotion_date' => $request->promotion_date,
                'description' => $request->description,
                'status' => $request->status ?? 0,
            ]);

            return response()->json([
                'status'  => true,
                'message' => "Promotion Created Successfully",
                'errors'  => null,
                'data'    => $promotion,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Put(
     * tags={"PDS User Promotion"},
     * path="/pds-backend/api/updatePromotion/{id}",
     * operationId="updatePromotion",
     * summary="Update Promotion Record",
     * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     * @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="employee_id", type="integer", example=1),
     *              @OA\Property(property="promotion_ref_number", type="text", example="2211"),
     *              @OA\Property(property="promoted_designation", type="integer", example="1"),
     *              @OA\Property(property="promotion_date", type="date", example="2023-03-23"),
     *              @OA\Property(property="description", type="text", example="good"),
     *              @OA\Property(property="status", type="integer", example=1),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Promotion Record Update Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */


    public function updatePromotion(Request $request, $id)
    {

        try {

            $rules = [
                'employee_id' => 'required',
                'promotion_ref_number' => 'required',
                'promoted_designation' => 'required',
                'promotion_date' => 'required',
                'description' => 'required',

            ];

            $messages = [
                'employee_id.required' => 'The employee_id field is required',
                'promotion_ref_number.required' => 'The promotion_ref_number field is required',
                'promoted_designation.required' => 'The promoted_designation field is required',
                'promotion_date.required' => 'The promotion_date field is required',
                'description.required' => 'The description field is required',

            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $promotion = Promotion::findOrFail($id);
            $promotion->employee_id = $request->employee_id;
            $promotion->promotion_ref_number = $request->promotion_ref_number;
            $promotion->promoted_designation = $request->promoted_designation;
            $promotion->promotion_date = $request->promotion_date;
            $promotion->description = $request->description;
            $promotion->save();

            return response()->json([
                'status'  => true,
                'message' => "Promotion Updated Successfully",
                'errors'  => null,
                'data'    => $promotion,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Delete(
     *     path="/pds-backend/api/deletePromotion/{id}",
     *     tags={"PDS User Promotion"},
     *     summary="Delete Promotion Record",
     *     description="Delete  Promotion Record With Valid ID",
     *     operationId="deletePromotion",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Delete Promotion Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function deletePromotion($id)
    {
        try {
            $promotion =  Promotion::findOrFail($id);
            $promotion->delete();

            return response()->json([
                'status'  => true,
                'message' => "Promotion Record Deleted Successfully",
                'errors'  => null,
                'data'    => $promotion,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/activePromotionRecord/{id}",
     *     tags={"PDS User Promotion"},
     *     summary="Active Promotion Record",
     *     description="Active Specific Promotion Record With Valid ID",
     *     operationId="activePromotionRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Active Promotion Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function activePromotionRecord($id)
    {
        try {
            $promotionInfo =  Promotion::find($id);

            if (!($promotionInfo === null)) {
                $promotionInfo = Promotion::where('id', '=', $id)->update(['status' => 1]);
                return response()->json([
                    'status'  => true,
                    'message' => "Actived Promotion Record Successfully",
                    'errors'  => null,
                    'data'    => $promotionInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Promotion Record Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Patch(
     *     path="/pds-backend/api/inactivePromotionRecord/{id}",
     *     tags={"PDS User Promotion"},
     *     summary="In-active Promotion Record",
     *     description="In-active Specific Promotion Record With Valid ID",
     *     operationId="inactivePromotionRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, In-active Promotion Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function inactivePromotionRecord($id)
    {
        try {
            $promotionInfo =  Promotion::find($id);

            if (!($promotionInfo === null)) {
                $promotionInfo = Promotion::where('id', '=', $id)->update(['status' => 0]);
                return response()->json([
                    'status'  => true,
                    'message' => "Inactived Promotion  Record Successfully",
                    'errors'  => null,
                    'data'    => $promotionInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Promotion Record Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Get(
     * tags={"PDS User Promotion"},
     * path="/pds-backend/api/specificUserPromotion/{id}",
     * operationId="specificUserPromotion",
     * summary="Get Specific User Promotion Record",
     * description="",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function specificUserPromotion(Request $request)
    {
        try {
            $specificUserPromotion = Promotion::findOrFail($request->id);
            return response()->json([
                'status' => 'success',
                'data' => $specificUserPromotion,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }
}
