<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;
use App\Models\Employee;
use DB;

class DropdownController extends Controller
{

    protected $responseRepository;
    public function __construct(ResponseRepository $rr)
    {
        $this->middleware('auth:api', ['except' => ['employeeList']]);
        $this->responseRepository = $rr;
    }


    /**
     * @OA\Get(
     * tags={"Dropdown Management"},
     * path= "/pds-backend/api/employeeList",
     * operationId="employeeList",
     * summary="Employee List",
     * description="Employee List",
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function employeeList(Request $request)
    {
        try {
            $employeeList = Employee::select('id', DB::raw('CONCAT(name," - ",mobile_number) as emp'))->get();
            return response()->json([
                'status' => 'success',
                'employeeList' => $employeeList,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }


}
