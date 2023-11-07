<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Repositories\ResponseRepository;
use DateTime;

class SeniorEmployeeController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rr)
    {
        // $this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rr;
    }
    /**
     * @OA\Get(
     * tags={"PDS Senior Employee "},
     * path= "/pds-backend/api/getSeniorEmployee",
     * operationId="getSeniorEmployee",
     * summary="Senior Employee List",
     * description="Total BloodGroup List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getSeniorEmployee()
    {
        try {

            $getSeniorEmployee = Employee::leftJoin('designations', 'designations.id', '=', 'employees.designation')
                ->leftJoin('departments', 'departments.id', '=', 'employees.department')
                ->select(
                    'employees.name',
                    'employees.date_of_birth',
                    'designations.designation_name as designation',
                    'departments.dept_name as department'
                )
                ->get();

            $senioremployeeArrays = [];

            foreach ($getSeniorEmployee as $employee) {

                $dateOfBirth = new DateTime($employee->date_of_birth);
                $currentDate = new DateTime();
                $age = $currentDate->diff($dateOfBirth)->y;

                if (50 <= $age) {
                    $senioremployeeArrays[] = [
                        'employee_name' => $employee->name,
                        'date_of_birth' => $employee->date_of_birth,
                        'designations' => $employee->designation,
                        'department' => $employee->department,
                        'age' => $age,
                    ];
                }
            }

            return response()->json([
                'status' => 'success',
                'data'   => $senioremployeeArrays
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
     * tags={"PDS Senior Employee "},
     * path="/pds-backend/api/getSeniorEmployeeById/{id}",
     * operationId="getSeniorEmployeeById",
     * summary="Get Senior Employee List",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getSeniorEmployeeById(Request $request, $id)
    {
        try {

            $getSeniorEmployee = Employee::leftJoin('designations', 'designations.id', '=', 'employees.designation')
                ->leftJoin('departments', 'departments.id', '=', 'employees.department')
                ->select(
                    'employees.name',
                    'employees.date_of_birth',
                    'designations.designation_name as designation',
                    'departments.dept_name as department'
                )
                ->where('employees.id', $id)
                ->first();

            $senioremployeeArrays = [];

            if ($getSeniorEmployee) {
                // Check if a valid employee record was found
                $dateOfBirth = new DateTime($getSeniorEmployee->date_of_birth);
                $currentDate = new DateTime();
                $age = $currentDate->diff($dateOfBirth)->y;

                if (50 <= $age) {
                    $senioremployeeArrays = [
                        'employee_name' => $getSeniorEmployee->name,
                        'date_of_birth' => $getSeniorEmployee->date_of_birth,
                        'designations' => $getSeniorEmployee->designation,
                        'department' => $getSeniorEmployee->department,
                        'age' => $age,
                    ];
                }
            }

            return response()->json([
                'status' => 'success',
                'data'   => $senioremployeeArrays
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
