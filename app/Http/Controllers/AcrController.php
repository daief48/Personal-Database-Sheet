<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Acr;
use App\Models\Employee;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


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
    // return $request->input();
    // Validation rules
    $rules = [
        'employee_id' => 'required',
        // 'emp_name' => 'required|string',
        // 'designation' => 'nullable|string', // Adjust as needed
        // 'department' => 'required|string',
        // 'office_name' => 'required|string',
        'acr_year' => 'required',
        // 'acr_date' => 'required|date',
        'score' => 'required',
        // 'file' => 'nullable|mimes:jpeg,png,pdf|max:2048', // Adjust allowed file types and size
        // 'rack_number' => 'required|string',
        // 'bin_number' => 'required|string',
        // 'file_number' => 'required|string',
        // 'remarks' => 'nullable|string',
        // 'status' => 'nullable|boolean',
    ];

    // Validation messages
    $messages = [
        // Add custom error messages for each field if needed
    ];

    // Validate the request
    $validator = Validator::make($request->all(), $rules, $messages);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors(),
            'data' => null,
        ], 422);
    }

    try {
        // Your existing code here...

        $fileNameToStore = null;

        // Rename and store the file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalFileName = $file->getClientOriginalName();
            $file_ext = $file->getClientOriginalExtension();
            $fileNameToStore = 'new_name_' . time() . '.' . $file_ext;

            // Move the file to the public path
            $file->move(public_path('Acr_file'), $fileNameToStore);
        }

        $acrInfo = Acr::create([
            'employee_id' => $request->employee_id,
            'emp_name' => $request->emp_name,
            'designation' => $request->designation ?? null,
            'department' => $request->department,
            'office_name' => $request->office_name,
            'acr_year' => $request->acr_year,
            'acr_date' => $request->acr_date,
            'score' => $request->score,
            'file' => $fileNameToStore,
            'rack_number' => $request->rack_number,
            'bin_number' => $request->bin_number,
            'file_number' => $request->file_number,
            'remarks' => $request->remarks,
            'status' => $request->status ?? 1,
        ]);

        // Optional: Remove old file if it exists
        if ($acrInfo->wasRecentlyCreated && $request->has('old_file')) {
            $pFile = public_path("Acr_file/{$request->old_file}");
            if (file_exists($pFile)) {
                unlink($pFile);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'ACR Mgt Created Successfully',
            'errors' => null,
            'data' => $acrInfo,
        ], 200);
    } catch (\Exception $e) {
        return $this->responseRepository->ResponseError('Error', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
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

            // Check if a new file is provided
            if ($request->hasFile('file')) {
                // Rename and store the file
                $file = $request->file('file');
                $originalFileName = $file->getClientOriginalName();
                $newFileName = 'new_name_' . time() . '_' . $originalFileName;

                // Move the file to the public path
                $file->move(public_path('Acr_file'), $newFileName);

                // Remove the old file if needed (optional)
                $pFile = public_path("Acr_file/{$acrInfo->file}");
                if (File::exists($pFile)) {
                    unlink($pFile);
                }

                // Update the file name in the database
                $acrInfo->file = $newFileName;
            }

            // Uncomment and adjust the following lines if needed
            $acrInfo->employee_id = $request->employee_id;
            $acrInfo->emp_name = $request->emp_name;
            $acrInfo->designation = $request->designation;
            $acrInfo->department = $request->department;
            $acrInfo->office_name = $request->office_name;
            $acrInfo->acr_year = $request->acr_year;
            $acrInfo->acr_date = $request->acr_year;
            $acrInfo->score = $request->score;
            $acrInfo->rack_number = $request->rack_number;
            $acrInfo->bin_number = $request->bin_number;
            $acrInfo->file_number = $request->file_number;
            $acrInfo->remarks = $request->remarks;
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
            $specificAcrInfo = Acr::leftjoin('employees', 'employees.id', '=', 'acrs.employee_id')
                ->select('employees.name', 'acrs.*')
                ->findOrFail($request->id);
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
    /**
     * @OA\Patch(
     *     path="/pds-backend/api/activeAcrRecord/{id}",
     *     tags={"PDS Annual Confidential Report Management(ACR)"},
     *     summary="Activate ACR Record",
     *     description="Activate Specific ACR Record With Valid ID",
     *     operationId="activateAcrRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successfully activated ACR Record"),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */


    public function activeAcrRecord($id)
    {
        try {
            $leaveTypeInfo = Acr::find($id);

            if (!($leaveTypeInfo === null)) {
                $leaveTypeInfo = Acr::where('id', '=', $id)->update(['status' => 1]);
                return response()->json([
                    'status'  => true,
                    'message' => "Actived Leave Type Record Successfully",
                    'errors'  => null,
                    'data'    => $leaveTypeInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'ACR Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
  /**
 * @OA\Patch(
 *     path="/pds-backend/api/inactiveAcrRecord/{id}",
 *     tags={"PDS Annual Confidential Report Management(ACR)"},
 *     summary="Inactivate ACR Record",
 *     description="Inactivate Specific ACR Record With Valid ID",
 *     operationId="inactiveAcrRecord",
 *     @OA\Parameter(name="id", description="id", example=1, required=true, in="path", @OA\Schema(type="integer")),
 *     @OA\Response(response=204, description="Successfully inactivated ACR Record"),
 *     @OA\Response(response=400, description="Bad Request"),
 *     @OA\Response(response=404, description="Resource Not Found"),
 *     security={{"bearer_token":{}}}
 * )
 */


    public function inactiveAcrRecord($id)
    {
        try {
            $acrRecord = Acr::find($id);

            if ($acrRecord) {
                Acr::where('id', $id)->update(['status' => 2]);
                return response()->json([], 204);
            } else {
                return $this->responseRepository->ResponseError(null, 'ACR Id is not valid!', Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
