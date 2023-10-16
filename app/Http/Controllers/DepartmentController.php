<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;


class DepartmentController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp,)
    {
        $this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }

    /**
     * @OA\Get(
     * tags={"PDS Department Setup"},
     * path= "/pds-backend/api/getDepartment",
     * operationId="getDepartment",
     * summary="Department List",
     * description="Total Promotion List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getDepartment()
    {
        try {

            $getDepartment = Department::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $getDepartment,
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
     * tags={"PDS Department Setup"},
     * path="/pds-backend/api/addDepartment",
     * operationId="addDepartment",
     * summary="Add New Department",
     * description="Add New Department",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *               @OA\Property(property="dept_name", type="text"),
     *               @OA\Property(property="create_at", type="text"),
     *               @OA\Property(property="status", type="text"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Added Department Setup Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */



    public function addDepartment(Request $request)
    {
        try {

            $department = Department::create([
                'dept_name' => $request->dept_name,
                'create_at' => $request->create_at,
                'status' => $request->status,
            ]);

            return response()->json([
                'status'  => true,
                'message' => "Department Created Successfully",
                'errors'  => null,
                'data'    => $department,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Put(
     * tags={"PDS Department Setup"},
     * path="/pds-backend/api/updateDepartment/{id}",
     * operationId="updateDepartment",
     * summary="Update Department Setup",
     * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     * @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="dept_name", type="text", example="xyz"),
     *              @OA\Property(property="create_at", type="text", example="2023-03-23"),
     *              @OA\Property(property="status", type="text", example=0),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Department Setup Update Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */


    public function updateDepartment(Request $request, $id)
    {

        try {

            $department = Department::findOrFail($id);
            $department->dept_name = $request->dept_name;
            $department->create_at = $request->create_at;
            $department->status = $request->status;
            $department->save();

            return response()->json([
                'status'  => true,
                'message' => "Department Updated Successfully",
                'errors'  => null,
                'data'    => $department,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Delete(
     *     path="/pds-backend/api/deleteDepartment/{id}",
     *     tags={"PDS Department Setup"},
     *     summary="Delete Department Record",
     *     description="Delete Department Record With Valid ID",
     *     operationId="deleteDepartment",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Delete Department Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function deleteDepartment($id)
    {
        try {
            $department =  Department::findOrFail($id);
            $department->delete();

            return response()->json([
                'status'  => true,
                'message' => "Department Record Deleted Successfully",
                'errors'  => null,
                'data'    => $department,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/activeDeptRecord/{id}",
     *     tags={"PDS Department Setup"},
     *     summary="Active Department Record",
     *     description="Active Specific Department Record With Valid ID",
     *     operationId="activeDeptRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Active Department Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function activeDeptRecord($id)
    {
        try {
            $deptInfo = Department::find($id);

            if (!($deptInfo === null)) {
                $deptInfo = Department::where('id', '=', $id)->update(['status' => 1]);
                return response()->json([
                    'status'  => true,
                    'message' => "Actived Department Record Successfully",
                    'errors'  => null,
                    'data'    => $deptInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Department Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Patch(
     *     path="/pds-backend/api/inactiveDeptRecord/{id}",
     *     tags={"PDS Department Setup"},
     *     summary="In-active Department Record",
     *     description="In-active Specific Department Record With Valid ID",
     *     operationId="inactiveDeptRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, In-active Promotion Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function inactiveDeptRecord($id)
    {
        try {
            $deptInfo =  Department::find($id);

            if (!($deptInfo === null)) {
                $deptInfo = Department::where('id', '=', $id)->update(['status' => 0]);
                return response()->json([
                    'status'  => true,
                    'message' => "Inactived Department  Record Successfully",
                    'errors'  => null,
                    'data'    => $deptInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Department Record Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     * tags={"PDS Department Setup"},
     * path="/pds-backend/api/specificDeptSetup/{id}",
     * operationId="specificDeptSetup",
     * summary="Specific Dept Setup",
     * description="",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function specificDeptSetup(Request $request)
    {
        try {
            $specificDeptSetup = Department::findOrFail($request->id);
            return response()->json([
                'status' => 'success',
                'data' => $specificDeptSetup,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }
}
