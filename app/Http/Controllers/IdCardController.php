<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Repositories\ResponseRepository;

class IdCardController extends Controller
{
    protected $responseRepository;
    public function __construct(ResponseRepository $rp)
    {
        //$this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }



    /**
     * @OA\Get(
     * tags={"PDS ID Card"},
     * path="/pds-backend/api/getIdCard/{id}",
     * operationId="getIdCard",
     * summary="Get Id Card",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getIdCard(Request $request, $id)
    {
        try {

            $getIdCard = Employee::leftJoin('designations', 'designations.id', '=', 'employees.designation')
                ->leftJoin('departments', 'departments.id', '=', 'employees.department')
                ->select(

                    'employees.name',
                    'employees.id',
                    'departments.dept_name as department',
                    'designations.designation_name as designation',
                    'employees.gender',

                )
                ->where('employees.id', $id)->first();

            return response()->json([
                'status' => 'success',
                'data'   => $getIdCard
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
