<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Transfer;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Request;

class ReportController extends Controller

{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp)
    {
        // $this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }

    /**
     * @OA\Get(
     * tags={"PDS Report"},
     * path= "/pds-backend/api/getShortReport",
     * operationId="getShortReport",
     * summary="PDS Report",
     * description="PDS Report",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getShortReport()
    {
        try {

            $getShortReport = Employee::select(
                'id',
                'name',
                'mobile_number',
                'image'
            )->orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $getShortReport,
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
     * tags={"PDS Report"},
     * path= "/pds-backend/api/getLongReport/{employee_id}",
     * operationId="getLongReport",
     * summary="PDS Report",
     * description="PDS Report",
     * @OA\Parameter(name="employee_id", description="employee_id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getLongReport(Request $request)
    {
        try {
            $getProfile = Employee::leftJoin('departments', 'departments.id', '=', 'employees.department')
                ->leftJoin('designations', 'designations.id', '=', 'employees.designation')
                ->select(
                    'employees.*',
                    'designations.id as designation_id',
                    'designations.designation_name as designation',
                    'departments.id as department_id',
                    'departments.dept_name as department'
                )
                ->where('employees.id', $request->employee_id)->first();

            $imgContent = public_path('/images/' . $getProfile->image);
            $contents = file_get_contents($imgContent);
            $baseEncode = 'data:image/png; base64,' . base64_encode($contents);

            $getTransferList = Transfer::leftJoin('transfer_types', 'transfers.transfer_type', '=', 'transfer_types.id')
                ->leftJoin('designations as to_designation', 'transfers.to_designation', '=', 'to_designation.id')
                ->leftJoin('designations as from_designation', 'transfers.from_designation', '=', 'from_designation.id')
                ->leftJoin('departments as to_department', 'transfers.to_department', '=', 'to_department.id')
                ->leftJoin('departments as from_department', 'transfers.from_department', '=', 'from_department.id')
                ->leftJoin('offices as to_office', 'transfers.to_office', '=', 'to_office.id')
                ->leftJoin('offices as from_office', 'transfers.from_office', '=', 'from_office.id')
                ->select(

                    'transfer_types.title as t_type',
                    'to_office.office_name as to_office',
                    'from_office.office_name as from_office',
                    'to_department.dept_name as to_department',
                    'from_department.dept_name as from_department',
                    'to_designation.designation_name as to_designation',
                    'from_designation.designation_name as from_designation',
                    'transfers.join_date',
                    'transfers.transfer_date',
                    'transfers.transfer_letter',
                )
                ->where('transfers.employee_id', $request->employee_id)
                ->get();

            return response()->json([
                'status' => 'success',
                'transferData' => $getTransferList,
                'profileData' => $getProfile,
                'encodeImg' =>  $baseEncode,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
