<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TrainingSetup;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;


class TrainingSetupController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp,)
    {
        //$this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }

    /**
     * @OA\Get(
     * tags={"PDS Training Setup"},
     * path= "/pds-backend/api/getTrainingMgt",
     * operationId="getTrainingMgt",
     * summary="Training Mgt List",
     * description="Total Training Mgt List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

     public function getTrainingMgt(){
        try {

            $getTrainingSetup = TrainingSetup::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'list' => $getTrainingSetup,
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
    * tags={"PDS Training Setup"},
    * path="/pds-backend/api/addTrainingMgt",
    * operationId="addTrainingMgt",
    * summary="Add New Training Mgt",
    * description="Add New Training Mgt",
    *     @OA\RequestBody(
    *         @OA\JsonContent(),
    *         @OA\MediaType(
    *            mediaType="multipart/form-data",
    *            @OA\Schema(
    *               type="object",
    *               required={},
    *               @OA\Property(property="training_name", type="text"),
    *               @OA\Property(property="create_at", type="text"),
    *               @OA\Property(property="status", type="text"),
    *            ),
    *        ),
    *    ),
    *      @OA\Response(
    *          response=200,
    *          description="Added Training Mgt Setup Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * ),
    *     security={{"bearer_token":{}}}
    */

    public function addTrainingMgt(Request $request){
        try {

            $trainingMgt = TrainingSetup::create([
                'training_name' => $request->training_name,
                'create_at' => $request->create_at,
                'status' => $request->status,
            ]);

            return response()->json([
                'status'  => true,
                'message' => "Training Mgt Created Successfully",
                'errors'  => null,
                'data'    => $trainingMgt,
            ], 200);

        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }




    /**
    * @OA\Put(
    * tags={"PDS Training Setup"},
    * path="/pds-backend/api/updateTrainingMgt/{id}",
    * operationId="updateTrainingMgt",
    * summary="Update Training Mgt Setup",
    * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
    * @OA\RequestBody(
    *          @OA\JsonContent(
    *              type="object",
    *              @OA\Property(property="training_name", type="text", example="xyz"),
    *              @OA\Property(property="create_at", type="text", example="2023-03-23"),
    *              @OA\Property(property="status", type="text", example=0),
    *          ),
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Training Mgt Setup Update Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * ),
    *     security={{"bearer_token":{}}}
    */


    public function updateTrainingMgt(Request $request, $id) {

        try {

            $trainingSetup = TrainingSetup::findOrFail($id);
            $trainingSetup->training_name = $request->training_name;
            $trainingSetup->create_at = $request->create_at;
            $trainingSetup->status = $request->status;
            $trainingSetup->save();

            return response()->json([
                'status'  => true,
                'message' => "Training Mgt Updated Successfully",
                'errors'  => null,
                'data'    => $trainingSetup,
            ], 200);

        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Delete(
     *     path="/pds-backend/api/deleteTrainingMgt/{id}",
     *     tags={"PDS Training Setup"},
     *     summary="Delete Training Mgt Record",
     *     description="Delete  Training Mgt  Record With Valid ID",
     *     operationId="deleteTrainingMgt",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Delete Training Mgt Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

     public function deleteTrainingMgt($id)
     {
         try {
             $trainingMgt =  TrainingSetup::findOrFail($id);
             $trainingMgt->delete();
 
             return response()->json([
                 'status'  => true,
                 'message' => "Training Mgt Record Deleted Successfully",
                 'errors'  => null,
                 'data'    => $trainingMgt,
             ], 200);
 
         } catch (\Exception $e) {
             return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
         }
     }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/activeTrainingMgtRecord/{id}",
     *     tags={"PDS Training Setup"},
     *     summary="Active Training Mgt Record",
     *     description="Active Specific Training Mgt Record With Valid ID",
     *     operationId="activeTrainingMgtRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Active Training Mgt Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function activeTrainingMgtRecord($id)
    {
        try {
            $trainingMgtInfo = TrainingSetup::find($id);

            if (!($trainingMgtInfo === null)) {
                $trainingMgtInfo = TrainingSetup::where('id', '=', $id)->update(['status' => 1]);
                return response()->json([
                    'status'  => true,
                    'message' => "Actived Training Mgt Record Successfully",
                    'errors'  => null,
                    'data'    => $trainingMgtInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Training Mgt Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/inactiveTrainingMgtRecord/{id}",
     *     tags={"PDS Training Setup"},
     *     summary="In-active Training Mgt Record",
     *     description="In-active Specific Training Mgt Record With Valid ID",
     *     operationId="inactiveTrainingMgtRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, In-active Training Mgt Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

     public function inactiveTrainingMgtRecord($id)
     {
         try {
             $trainingMgtInfo =  TrainingSetup::find($id);
 
             if (!($trainingMgtInfo === null)) {
                 $trainingMgtInfo = TrainingSetup::where('id', '=', $id)->update(['status' => 0]);
                 return response()->json([
                     'status'  => true,
                     'message' => "Inactived Training Mgt Record Successfully",
                     'errors'  => null,
                     'data'    => $trainingMgtInfo,
                 ], 200);
             } else {
                 return $this->responseRepository->ResponseSuccess(null, 'Training Mgt Record Id Are Not Valid!');
             }
         } catch (\Exception $e) {
             return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
         }
     }


    /**
    * @OA\Get(
    * tags={"PDS Training Setup"},
    * path="/pds-backend/api/specificTrainingSetup/{id}",
    * operationId="specificTrainingSetup",
    * summary="Specific Training Setup",
    * description="Specific Training Setup",
    * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
    * @OA\Response(response=200, description="Success" ),
    * @OA\Response(response=400, description="Bad Request"),
    * @OA\Response(response=404, description="Resource Not Found"),
    * ),
    * security={{"bearer_token":{}}}
    */

    public function specificTrainingSetup(Request $request){
        try {
            $specificTrainingSetup = TrainingSetup::findOrFail($request->id);
            return response()->json([
                'status' => 'success',
                'data' => $specificTrainingSetup,
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }


}