<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

use Illuminate\Support\Facades\Auth;
use App\Models\Grade;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;
use Validator;

class GradeController extends Controller
{
    protected $responseRepository;
    public function __construct(ResponseRepository $rp)
    {
        // $this->middleware('auth:api', ['except' => []]);
        // $this->responseRepository = $rp;
    }

    /**
     * @OA\Get(
     * tags={"PDS Grade Setup"},
     * path= "/pds-backend/api/getGradeMgt",
     * operationId="getGradeMgt",
     * summary="Grade Mgt List",
     * description="Total Grade Mgt List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getGradeMgt()
    {
        try {

            $getOfficeSetup = Grade::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'list' => $getOfficeSetup,
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
     * tags={"PDS Grade Setup"},
     * path="/pds-backend/api/addGradeMgt",
     * operationId="addGradeMgt",
     * summary="Add New Grade Mgt",
     * description="Add New Grade Mgt",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *               @OA\Property(property="job_grade", type="text"),
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

    // ... (no changes to the method signature)

    public function addGradeMgt(Request $request)
    {
        try {
            $rules = [
                'job_grade' => 'required|max:255',
                'status' => 'required|max:255',
                // Add validation rules for other fields here
            ];

            $messages = [
                'job_grade.required' => 'The job_grade field is required',
                'status.required' => 'The status field is required',
                // Add custom error messages for other fields if needed
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $GradeInfo = Grade::create([
                'job_grade' => $request->job_grade,
                'status' => $request->status ?? 0,
                // Add other fields here if needed
            ]);

            return response()->json([
                'status'  => true,
                'message' => "Grade Mgt Created Successfully",
                'errors'  => null,
                'data'    => $GradeInfo,
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {

            return $this->responseRepository->ResponseError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Put(
     * tags={"PDS Grade Setup"},
     * path="/pds-backend/api/updateGradeMgt/{id}",
     * operationId="updateGradeMgt",
     * summary="Update Grade Mgt Setup",
     * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     * @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="job_grade", type="text", example="xyz"),
     *              @OA\Property(property="status", type="text", example=0),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Grade Mgt Setup Update Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function updateGradeMgt(Request $request, $id)
    {

        try {
            $rules = [

                'job_grade' => 'required',
                'status' => 'required',
                // Add validation rules for other fields here
            ];

            $messages = [

                'job_grade.required' => 'The job_grade	 field is required',
                'status.required' => 'The status field is required',
                // Add custom error messages for other fields if needed
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $GradeInfo = Grade::findOrFail($id);
            $GradeInfo->job_grade = $request->job_grade;
            $GradeInfo->status = $request->status;
            $GradeInfo->save();

            return response()->json([
                'status'  => true,
                'message' => "Grade Mgt Updated Successfully",
                'errors'  => null,
                'data'    => $GradeInfo,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Delete(
     *     path="/pds-backend/api/deleteGradeMgt/{id}",
     *     tags={"PDS Grade Setup"},
     *     summary="Delete Grade Mgt Record",
     *     description="Delete Grade Mgt Record With Valid ID",
     *     operationId="deleteGradeMgt",
     *     @OA\Parameter(name="id", description="id", example=1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successfully, Delete Grade Mgt Record"),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function deleteGradeMgt($id)
    {
        try {
            $grade =  Grade::findOrFail($id);
            $employeeData = Employee::where('job_grade', '=', $id)->count();
            if ($employeeData === 0) {
                $grade->delete();
                return response()->json([
                    'status' => true,
                    'message' => "Office Record Deleted Successfully",
                    'errors' => null,
                    'data' => $grade,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Office Record cannot be deleted. Used this data in another module.",
                    'errors' => null,
                    'data' => $grade,
                ], 400);
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Patch(
     *     path="/pds-backend/api/inactiveGradeMgtRecord/{id}",
     *     tags={"PDS Grade Setup"},
     *     summary="In-active Grade Mgt Record",
     *     description="In-active Specific Grade Mgt Record With Valid ID",
     *     operationId="inactiveGradeMgtRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, In-active Grade Mgt Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function inactiveGradeMgtRecord($id)
    {
        try {
            $officeMgtInfo =  Grade::find($id);

            if (!($officeMgtInfo === null)) {
                $officeMgtInfo = Grade::where('id', '=', $id)->update(['status' => 2]);
                return response()->json([
                    'status'  => true,
                    'message' => "Inactived Grade Mgt Successfully",
                    'errors'  => null,
                    'data'    => $officeMgtInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Grade Mgt Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/activeGradeMgtRecord/{id}",
     *     tags={"PDS Grade Setup"},
     *     summary="Active Grade Mgt Record",
     *     description="Active Specific Grade Mgt Record With Valid ID",
     *     operationId="activeGradeMgtRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Active Grade Mgt Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function activeGradeMgtRecord($id)
    {
        try {
            $officeMgtInfo = Grade::find($id);

            if (!($officeMgtInfo === null)) {
                $officeMgtInfo = Grade::where('id', '=', $id)->update(['status' => 1]);
                return response()->json([
                    'status'  => true,
                    'message' => "Actived Grade Mgt Record Successfully",
                    'errors'  => null,
                    'data'    => $officeMgtInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Grade Mgt Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     * tags={"PDS Grade Setup"},
     * path="/pds-backend/api/specificGradeSetup/{id}",
     * operationId="specificGradeSetup",
     * summary="Specific Grade Setup",
     * description="Specific Grade Setup",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function specificGradeSetup(Request $request)
    {
        try {
            $specificGradeSetup = Grade::findOrFail($request->id);
            return response()->json([
                'status' => 'success',
                'data' => $specificGradeSetup,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }
}
