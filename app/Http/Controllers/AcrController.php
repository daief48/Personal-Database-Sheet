<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Acr;
use App\Models\Employee;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;


class AcrController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp)
    {
        //$this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }

    /**
     * @OA\Get(
     * tags={"PDS Annual Confidential Report Management(ACR)"},
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

    public function getAcr()
    {
        try {

            $getAcr = Acr::leftJoin('designations', 'designations.id', '=', 'acrs.designation')
                ->leftJoin('departments', 'departments.id', '=', 'acrs.department')
                ->leftjoin('offices', 'offices.id', '=', 'acrs.office_name')
                ->leftjoin('employees', 'employees.id', '=', 'acrs.employee_id')
                ->select(
                    'acrs.*',
                    'employees.name',
                    'departments.dept_name as department',
                    'designations.designation_name as designation',
                    'offices.office_name'
                );
            // ->get();

            $userRole = Auth::user()->role_id;
            if ($userRole == 1) {
                $getAcr = $getAcr->get();
            } else {
                $employeeInfo = Employee::where('user_id', Auth::user()->id)->first();
                $getAcr = $getAcr->where('acrs.employee_id', $employeeInfo->id)->select('acrs.acr_year', 'acrs.status')->get();
            }
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
     * tags={"PDS Annual Confidential Report Management(ACR)"},
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
     *               @OA\Property(property="employee_id", type="text"),
     *               @OA\Property(property="emp_name", type="date"),
     *               @OA\Property(property="designation", type="date"),
     *               @OA\Property(property="department", type="text"),
     *               @OA\Property(property="office_name", type="text"),
     *               @OA\Property(property="acr_year", type="text"),
     *               @OA\Property(property="score", type="text"),
     *               @OA\Property(property="file", type="text"),
     *               @OA\Property(property="rack_number", type="text"),
     *               @OA\Property(property="bin_number", type="text"),
     *               @OA\Property(property="file_number", type="text"),
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

    public function addAcr(Request $request)
    {
        try {

            $acrInfo = Acr::create([
                'employee_id' => $request->employee_id,
                'emp_name' => $request->emp_name,
                'designation' => $request->designation,
                'department' => $request->department,
                'office_name' => $request->office_name,
                'acr_year' => $request->acr_year,
                'score' => $request->score,
                'file' => $request->file,
                'rack_number' => $request->rack_number,
                'bin_number' => $request->bin_number,
                'file_number' => $request->file_number,
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
     * tags={"PDS Annual Confidential Report Management(ACR)"},
     * path="/pds-backend/api/updateAcrMgt/{id}",
     * operationId="updateAcrMgt",
     * summary="Update ACR Mgt Setup",
     * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     * @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="employee_id", type="text", example="2"),
     *              @OA\Property(property="emp_name", type="date", example="Yeasin"),
     *              @OA\Property(property="designation", type="date", example="2"),
     *              @OA\Property(property="department", type="text", example="2"),
     *              @OA\Property(property="office_name", type="text", example="2"),
     *              @OA\Property(property="acr_year", type="text", example="2023"),
     *              @OA\Property(property="score", type="text", example="4"),
     *              @OA\Property(property="file", type="text", example="file_update"),
     *              @OA\Property(property="rack_number", type="text", example="2"),
     *              @OA\Property(property="bin_number", type="text", example="2023"),
     *              @OA\Property(property="file_number", type="text", example="4"),
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

    public function updateAcrMgt(Request $request, $id)
    {

        try {

            $acrInfo = Acr::findOrFail($id);
            // $acrInfo->employee_id = $request->employee_id;
            $acrInfo->emp_name = $request->emp_name;
            $acrInfo->designation = $request->designation;
            $acrInfo->department = $request->department;
            $acrInfo->office_name = $request->office_name;
            $acrInfo->acr_year = $request->acr_year;
            $acrInfo->score = $request->score;
            $acrInfo->file = $request->file;
            $acrInfo->rack_number = $request->rack_number;
            $acrInfo->bin_number = $request->bin_number;
            $acrInfo->file_number = $request->file_number;
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
     * tags={"PDS Annual Confidential Report Management(ACR)"},
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

    public function specificAcrInfo(Request $request)
    {
        try {
            $specificAcrInfo = Acr::leftJoin('designations', 'designations.id', '=', 'acrs.designation')
                ->leftJoin('departments', 'departments.id', '=', 'acrs.department')
                ->leftjoin('offices', 'offices.id', '=', 'acrs.office_name')
                ->leftjoin('employees', 'employees.id', '=', 'acrs.employee_id')
                ->select(
                    'acrs.*',
                    'employees.name',
                    'departments.dept_name as department',
                    'designations.designation_name as designation',
                    'offices.office_name'
                )->findOrFail($request->id);
            return response()->json([
                'status' => 'success',
                'data' => $specificAcrInfo,
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
     * tags={"PDS Annual Confidential Report Management(ACR)"},
     * path="/pds-backend/api/getprofileForAcr/{id}",
     * operationId="getprofileForAcr",
     * summary="Get Id Card",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getprofileForAcr($id)
    {
        try {

            $getprofileForAcr = Employee::leftJoin('designations', 'designations.id', '=', 'employees.designation')
                ->leftJoin('departments', 'departments.id', '=', 'employees.department')
                ->leftjoin('offices', 'offices.employee_id', '=', 'employees.id')
                ->select(

                    'employees.name',
                    'departments.dept_name as department',
                    'designations.designation_name as designation',
                    'offices.office_name'
                )
                ->where('employees.id', $id)->first();

            return response()->json([
                'status' => 'success',
                'data'   => $getprofileForAcr
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }



    /**
     * @OA\Get(
     * tags={"PDS Annual Confidential Report Management(ACR)"},
     * path="/pds-backend/api/getAcrListByEmployeeId/{id}",
     * operationId="getAcrListByEmployeeId",
     * summary="Specific Acr Info Detail",
     * description="",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getAcrListByEmployeeId(Request $request, $id)
    {
        try {
            $getAcrListByEmployeeId = Acr::select(
                'acr_year',
                'status',

            )->where('acrs.employee_id', $id)->get();

            return response()->json([
                'status' => 'success',
                'data' => $getAcrListByEmployeeId,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }

    /**
     * @OA\Delete(
     *     tags={"PDS Annual Confidential Report Management(ACR)"},
     *     path="/pds-backend/api/deleteAcrInfo/{id}",
     *     summary="Delete Transfer Record",
     *     description="Delete  Transfer Record With Valid ID",
     *     operationId="deleteAcrInfo",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Delete Album" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function deleteAcrInfo($id)
    {
        try {
            $AcrInfo =  Acr::findOrFail($id);
            $AcrInfo->delete();

            return response()->json([
                'status'  => true,
                'message' => "Transfer Record deleted successfully",
                'errors'  => null,
                'data'    => $AcrInfo,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
