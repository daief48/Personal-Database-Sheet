<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Training;
use App\Repositories\ResponseRepository;
use Validator;
use Illuminate\Http\Response;
use File;


class TrainingController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp)
    {
        //$this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }

    /**
     * @OA\Get(
     * tags={"PDS User Training"},
     * path= "/pds-backend/api/getTrainingList",
     * operationId="getTrainingList",
     * summary="Training List",
     * description="Total Training List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getTrainingList()
    {
        try {

            $getTrainingList = Training::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'list' => $getTrainingList,
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
     * tags={"PDS User Training"},
     * path="/pds-backend/api/addTrainingRecord",
     * operationId="addTrainingRecord",
     * summary="Add New Training Record",
     * description="Add New Training Record",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *               @OA\Property(property="employee_id", type="integer",example=1),
     *               @OA\Property(property="training_name", type="text"),
     *               @OA\Property(property="training_center_name", type="text"),
     *               @OA\Property(property="training_score", type="text"),
     *               @OA\Property(property="training_feedback", type="text"),
     *               @OA\Property(property="training_strt_date", type="text"),
     *               @OA\Property(property="training_end_date", type="text"),
     *               @OA\Property(property="description", type="date"),
     *               @OA\Property(property="status", type="text"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Added  Training Record Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function addTrainingRecord(Request $request)
    {
        try {

            $rules = [
                'employee_id' => 'required',
                'training_name' => 'required',
                'training_center_name' => 'required',
                'training_score' => 'required',
                'training_feedback' => 'required',
                'training_strt_date' => 'required',
                'training_end_date' => 'required',
                'description' => 'required',

            ];

            $messages = [
                'employee_id.required' => 'The employee_id field is required',
                'training_name.required' => 'The training_name field is required',
                'training_center_name.required' => 'The training_center_name field is required',
                'training_score.required' => 'The training_score field is required',
                'training_feedback.required' => 'The training_feedback field is required',
                'training_strt_date.required' => 'The training_strt_date field is required',
                'training_end_date.required' => 'The training_end_date field is required',
                'description.required' => 'The description field is required',


            ];
            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }




            $addTraining = Training::create([
                'employee_id' => $request->employee_id,
                'training_name' => $request->training_name,
                'training_center_name' => $request->training_center_name,
                'training_score' => $request->training_score,
                'training_feedback' => $request->training_feedback,
                'training_strt_date' => $request->training_strt_date,
                'training_end_date' => $request->training_end_date,
                'description' => $request->description,
                'status' => $request->status ?? 0,
            ]);
            return $this->responseRepository->ResponseSuccess($addTraining, 'Training Record Added Successfully !');
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Put(
     * tags={"PDS User Training"},
     * path="/pds-backend/api/updateTrainingRecord/{id}",
     * operationId="updateTrainingRecord",
     * summary="Update Training Record",
     * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     * @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="employee_id", type="integer",example=1),
     *              @OA\Property(property="training_name", type="text", example="Food"),
     *              @OA\Property(property="training_center_name", type="text", example="Mymensingh"),
     *              @OA\Property(property="training_score", type="text", example="80"),
     *              @OA\Property(property="training_feedback", type="text", example="better"),
     *              @OA\Property(property="training_strt_date", type="text", example="2023-03-23"),
     *              @OA\Property(property="training_end_date", type="text", example="2023-03-23"),
     *              @OA\Property(property="description", type="text", example="good"),
     *              @OA\Property(property="status", type="text", example=1),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Training Update Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function updateTrainingRecord(Request $request, $id)
    {
        try {

            $rules = [
                'employee_id' => 'required',
                'training_name' => 'required',
                'training_center_name' => 'required',
                'training_score' => 'required',
                'training_feedback' => 'required',
                'training_strt_date' => 'required',
                'training_end_date' => 'required',
                'description' => 'required',
            ];

            $messages = [
                'employee_id.required' => 'The employee_id field is required',
                'training_name.required' => 'The training_name field is required',
                'training_center_name.required' => 'The training_center_name field is required',
                'training_score.required' => 'The training_score field is required',
                'training_feedback.required' => 'The training_feedback field is required',
                'training_strt_date.required' => 'The training_strt_date field is required',
                'training_end_date.required' => 'The training_end_date field is required',
                'description.required' => 'The description field is required',


            ];
            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $training = Training::findOrFail($id);
            $training->employee_id = $request->employee_id;
            $training->training_name = $request->training_name;
            $training->training_center_name = $request->training_center_name;
            $training->training_score = $request->training_score;
            $training->training_feedback = $request->training_feedback;
            $training->training_strt_date = $request->training_strt_date;
            $training->training_end_date = $request->training_end_date;
            $training->description = $request->description;
            $training->status = $request->status;
            $training->save();

            return response()->json([
                'status'  => true,
                'message' => "Training Record Updated Successfully",
                'errors'  => null,
                'data'    => $request->all(),
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Delete(
     *     path="/pds-backend/api/deleteTrainingRecord/{id}",
     *     tags={"PDS User Training"},
     *     summary="Delete Training Record",
     *     description="Delete Training Record With Valid ID",
     *     operationId="deleteTrainingRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Delete Training Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function deleteTrainingRecord($id)
    {
        try {
            $training =  Training::findOrFail($id);
            $training->delete();

            return response()->json([
                'status'  => true,
                'message' => "Training Record Deleted Successfully",
                'errors'  => null,
                'data'    => $training,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/activeTrainingRecord/{id}",
     *     tags={"PDS User Training"},
     *     summary="Active Training Record",
     *     description="Active Specific Training Record With Valid ID",
     *     operationId="activeTrainingRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Active Training Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function activeTrainingRecord($id)
    {
        try {
            $trainingInfo =  Training::find($id);

            if (!($trainingInfo === null)) {
                $trainingInfo = Training::where('id', '=', $id)->update(['status' => 1]);
                return response()->json([
                    'status'  => true,
                    'message' => "Actived Training Record Successfully",
                    'errors'  => null,
                    'data'    => $trainingInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Training Record Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Patch(
     *     path="/pds-backend/api/inactiveTrainingRecord/{id}",
     *     tags={"PDS User Training"},
     *     summary="In-active Training Record",
     *     description="In-active Specific Training Record With Valid ID",
     *     operationId="inactiveTrainingRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, In-active Training Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function inactiveTrainingRecord($id)
    {
        try {
            $trainingInfo =  Training::find($id);

            if (!($trainingInfo === null)) {
                $trainingInfo = Training::where('id', '=', $id)->update(['status' => 0]);
                return response()->json([
                    'status'  => true,
                    'message' => "Inactived Training Record Successfully",
                    'errors'  => null,
                    'data'    => $trainingInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Training Record Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     * tags={"PDS User Training"},
     * path="/pds-backend/api/specificUserTraining/{id}",
     * operationId="specificUserTraining",
     * summary="Get Specific Training Record",
     * description="",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function specificUserTraining(Request $request)
    {
        try {
            $specificUserTraining = Training::findOrFail($request->id);
            return response()->json([
                'status' => 'success',
                'data' => $specificUserTraining,
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
     *     tags={"PDS User Training"},
     *     path="/pds-backend/api/specificUserTrainingRecordByEmployeeId/{employee_id}",
     *     operationId="specificUserTrainingRecordByEmployeeId",
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
    public function specificUserTrainingRecordByEmployeeId(Request $request)
    {
        try {
            $getTrainingList = Training::leftJoin('employees', 'employees.id', '=', 'trainings.employee_id')
                ->select('employees.id as employee_id','employees.name as employee_name', 'trainings.*')
                ->where('trainings.employee_id', $request->employee_id)
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
}
