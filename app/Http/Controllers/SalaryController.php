<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

use App\Repositories\ResponseRepository;


class SalaryController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp)
    {
        //$this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }



    /**
     * @OA\Get(
     * tags={"PDS User Salary"},
     * path= "/pds-backend/api/getSalary",
     * operationId="getSalary",
     * summary="Salary List",
     * description="Total Salary List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getSalary()
    {
        try {

            $getSalary = Salary::leftJoin('employees', 'employees.id', '=', 'salaries.employee_id')
                ->select(
                    'salaries.*',
                    'employees.id as emp_id',
                    'employees.name',

                )->orderBy('id', 'desc')->get();

            return response()->json([
                'status' => 'success',
                'list' => $getSalary,
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
     * tags={"PDS User Salary"},
     * path= "/pds-backend/api/getSalaryByEmployeeId/{employee_id}",
     * operationId="getSalaryByEmployeeId",
     * summary="Salary List",
     * description="Total Salary List",
     *  @OA\Parameter(
     *         name="employee_id", description="Employee ID",  example=1, required=true,in="path",@OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Success"),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Not Found"),
     *     security={{"bearer_token": {}}}
     * )
     */

    public function getSalaryByEmployeeId(Request $request)
    {
        try {

            $getSalary = Salary::leftJoin('employees', 'employees.id', '=', 'salaries.employee_id')
                ->select(
                    'salaries.*',
                    'employees.id as emp_id',
                    'employees.name',
                    'employees.job_location',

                )->where('salaries.employee_id', $request->employee_id)
                ->orderBy('id', 'desc')->get();

            return response()->json([
                'status' => 'success',
                'list' => $getSalary,
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
     * tags={"PDS User Salary"},
     * path="/pds-backend/api/addSalary",
     * operationId="addSalary",
     * summary="Add New Salary",
     * description="Add New Salary",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *               @OA\Property(property="employee_id", type="integer",example=1),
     *               @OA\Property(property="grade", type="integer"),
     *                @OA\Property(property="basic_pay", type="integer"),
     *                @OA\Property(property="medical_allowance", type="integer"),
     *                @OA\Property(property="house_rent", type="integer"),
     *               @OA\Property(property="others", type="integer"),
     *               @OA\Property(property="status", type="integer"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Added Salary Record Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */



    public function addSalary(Request $request)
    {
        try {
            $rules = [
                'employee_id' => 'required|unique:salaries',
                'grade' => 'required',
                'basic_pay' => 'required',
                'medical_allowance' => 'required',
                'house_rent' => 'required',
                'others' => 'required',
            ];

            $messages = [
                'employee_id.unique' => 'The employee_id is already exists',

                'employee_id.required' => 'The employee_id field is required',
                'grade.required' => 'The Salary_ref_number field is required',
                'basic_pay.required' => 'The basic_pay field is required',
                'medical_allowance.required' => 'The medical_allowance field is required',
                'house_rent.required' => 'The house_rent field is required',
                'others.required' => 'The others field is required',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }


            $total_amount = $request->basic_pay + $request->medical_allowance + $request->house_rent + $request->others;

            $Salary = Salary::create([
                'employee_id' => $request->employee_id,
                'grade' => $request->grade,
                'basic_pay' => $request->basic_pay,
                'medical_allowance' => $request->medical_allowance,
                'house_rent' => $request->house_rent,
                'others' => $request->others,
                'salary_amount' => $total_amount,
                'status' => $request->status ?? 0,
            ]);

            return response()->json([
                'status'  => true,
                'message' => "Salary Created Successfully",
                'errors'  => null,
                'data'    => $Salary,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Put(
     * tags={"PDS User Salary"},
     * path="/pds-backend/api/updateSalary/{id}",
     * operationId="updateSalary",
     * summary="Update Salary Record",
     * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     * @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="employee_id", type="integer", example=1),
     *              @OA\Property(property="grade", type="integer", example=2),
     *              @OA\Property(property="basic_pay", type="integer", example=2),
     *               @OA\Property(property="medical_allowance", type="integer", example=2),
     *              @OA\Property(property="house_rent", type="integer", example=2),
     *              @OA\Property(property="others", type="integer", example=1),
     *              @OA\Property(property="status", type="integer", example=1),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Salary Record Update Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */


    public function updateSalary(Request $request, $id)
    {

        try {
            $rules = [

                'grade' => 'required',
                'basic_pay' => 'required',
                'medical_allowance' => 'required',
                'house_rent' => 'required',
                'others' => 'required',
            ];

            $messages = [


                'employee_id.required' => 'The employee_id field is required',
                'grade.required' => 'The Salary_ref_number field is required',
                'basic_pay.required' => 'The basic_pay field is required',
                'medical_allowance.required' => 'The medical_allowance field is required',
                'house_rent.required' => 'The house_rent field is required',
                'others.required' => 'The others field is required',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $total_amount = $request->basic_pay + $request->medical_allowance + $request->house_rent + $request->others;

            $Salary = Salary::findOrFail($id);

            $Salary->grade = $request->grade;
            $Salary->basic_pay = $request->basic_pay;
            $Salary->medical_allowance = $request->medical_allowance;
            $Salary->house_rent = $request->house_rent;
            $Salary->others = $request->others;
            $Salary->salary_amount = $total_amount;
            $Salary->status = $request->status;
            $Salary->save();

            return response()->json([
                'status'  => true,
                'message' => "Salary Updated Successfully",
                'errors'  => null,
                'data'    => $Salary,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Delete(
     *     path="/pds-backend/api/deleteSalary/{id}",
     *     tags={"PDS User Salary"},
     *     summary="Delete Salary Record",
     *     description="Delete  Salary Record With Valid ID",
     *     operationId="deleteSalary",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Delete Salary Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function deleteSalary($id)
    {
        try {
            $Salary =  Salary::findOrFail($id);
            $Salary->delete();

            return response()->json([
                'status'  => true,
                'message' => "Salary Record Deleted Successfully",
                'errors'  => null,
                'data'    => $Salary,
            ], 200);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/activeSalaryRecord/{id}",
     *     tags={"PDS User Salary"},
     *     summary="Active Salary Record",
     *     description="Active Specific Salary Record With Valid ID",
     *     operationId="activeSalaryRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, Active Salary Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function activeSalaryRecord($id)
    {
        try {
            $SalaryInfo =  Salary::find($id);

            if (!($SalaryInfo === null)) {
                $SalaryInfo = Salary::where('id', '=', $id)->update(['status' => 1]);
                return response()->json([
                    'status'  => true,
                    'message' => "Actived Salary Record Successfully",
                    'errors'  => null,
                    'data'    => $SalaryInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Salary Record Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/pds-backend/api/inactiveSalaryRecord/{id}",
     *     tags={"PDS User Salary"},
     *     summary="In-active Salary Record",
     *     description="In-active Specific Salary Record With Valid ID",
     *     operationId="inactiveSalaryRecord",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Successfully, In-active Salary Record" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function inactiveSalaryRecord($id)
    {
        try {
            $SalaryInfo =  Salary::find($id);

            if (!($SalaryInfo === null)) {
                $SalaryInfo = Salary::where('id', '=', $id)->update(['status' => 2]);
                return response()->json([
                    'status'  => true,
                    'message' => "Inactived Salary  Record Successfully",
                    'errors'  => null,
                    'data'    => $SalaryInfo,
                ], 200);
            } else {
                return $this->responseRepository->ResponseSuccess(null, 'Salary Record Id Are Not Valid!');
            }
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
