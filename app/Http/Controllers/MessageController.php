<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use App\Models\Message;

class MessageController extends Controller


{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp)
    {
        // $this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }

    /**
     * @OA\Post(
     * tags={"PDS Send Message"},
     * path="/pds-backend/api/sendMessage",
     * operationId="sendMessage",
     * summary="Send New Message",
     * description="Send New Message",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *                @OA\Property(property="subject", type="text"),
     *               @OA\Property(property="phone", type="integer"),
     *               @OA\Property(property="designation", type="text"),
     *               @OA\Property(property="office", type="text"),
     *               @OA\Property(property="from", type="text"),
     *                @OA\Property(property="message", type="text"),
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



    public function sendMessage(Request $request)
    {
        try {
            // $rules = [
            //     'subject' => 'required',
            //     'phone' => 'required',
            //     'designation' => 'required',
            //     'office' => 'required',
            //     'from' => 'required',
            //     'message' => 'required',

            // ];

            // $messages = [
            //     'subject.required' => 'The subject field is required',
            //     'phone.required' => 'The phone field is required',
            //     'office.required' => 'The office field is required',
            //     'designation.required' => 'The designation_name field is required',
            //     'from.required' => 'The from field is required',
            //     'message.required' => 'The message field is required',

            // ];

            // $validator = Validator::make($request->all(), $rules, $messages);
            // if ($validator->fails()) {
            //     return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            // }

            $message = "From: GHIT, Subject: " . $request->subject . ', Message:' . $request->message;

            $url = env("MESSAGE_OTP_API", "http");
            $response = Http::withToken('token')->post($url, [
                'mobileNumber' => $request->phone,
                'message' => $message,
            ])->throw(function (Response $response, RequestException $e) {
            })->json();

            if ($response['status'] == 'SUCCESS') {

                $addMessage = Message::create([
                    'subject' => $request->subject,
                    'phone' => $request->phone,
                    'designation' => $request->designation,
                    'office' => $request->office,
                    'from' => $request->from,
                    'message' => $request->from,
                ]);
            }


            return response()->json([
                'status' => 'success',
                'message' => $response,
                'data' => $addMessage

            ]);
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Get(
     * tags={"PDS Send Message"},
     * path="/pds-backend/api/getMessageInfoById/{id}",
     * operationId="getMessageInfoById",
     * summary="Get Id Card",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getMessageInfoById(Request $request, $id)
    {
        try {

            $getMessageInfoById = Employee::leftJoin('designations', 'designations.id', '=', 'employees.designation')
                ->leftJoin('departments', 'departments.id', '=', 'employees.department')
                ->leftJoin('offices', 'offices.id', '=', 'employees.id')
                ->select(

                    'employees.name',
                    'employees.id',
                    'departments.dept_name as department',
                    'designations.designation_name as designation',
                    'employees.gender',
                    'offices.office_name'

                )
                ->where('employees.id', $id)->first();

            return response()->json([
                'status' => 'success',
                'data'   => $getMessageInfoById
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
     * tags={"PDS Send Message"},
     * path="/pds-backend/api/getOfficeListAndPhoneNumberByDepartment/{id}",
     * operationId="getOfficeListAndPhoneNumberByDepartment",
     * summary="getOfficeListAndPhoneNumberByDepartment",
     * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Success" ),
     * @OA\Response(response=400, description="Bad Request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * ),
     * security={{"bearer_token":{}}}
     */

    public function getOfficeListAndPhoneNumberByDepartment(Request $request, $id)
    {
        try {

            $getDepartmentInfo = Employee::leftJoin('offices', 'offices.id', '=', 'employees.office')
                ->select(
                    'employees.id as employee_id',
                    'employees.office',
                    'employees.mobile_number',
                    'offices.office_name'
                )
                ->where('employees.designation', $id)->get();

            $officeListArr = [];
            $phoneNumberArr = [];
            foreach ($getDepartmentInfo as $empDepartmentInfo) {
                $officeName = $empDepartmentInfo['office'];

                $officeListArr[$officeName][] = $empDepartmentInfo->office_name;
                $phoneNumberArr[] = $empDepartmentInfo->mobile_number;
            }
            return response()->json([
                'status' => 'success',
                'data'   => $officeListArr,
                'phonedata'   => $phoneNumberArr

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
     *     tags={"PDS Send Message"},
     *     path="/pds-backend/api/getPhoneNumberByOffice/{designationId}/{officeId}",
     *     operationId="getPhoneNumberByOffice",
     *     summary="getPhoneNumberByOffice",
     *     @OA\Parameter(name="designationId", description="designationId", example=1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Parameter(name="officeId", description="officeId", example=1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Success"),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     security={{"bearer_token":{}}}
     * )
     */

    public function getPhoneNumberByOffice(Request $request, $designationId, $officeId)
    {
        try {
            $getOfficeInfo = Employee::leftJoin('offices', 'offices.id', '=', 'employees.office')
                ->select(
                    'employees.id as employee_id',
                    'employees.office',
                    'employees.mobile_number',
                    'offices.office_name'
                )
                ->where('employees.designation', $designationId)
                ->where('employees.office', $officeId)
                ->get();

            $phoneNumberArr = [];
            foreach ($getOfficeInfo as $empOfficeInfo) {
                $phoneNumberArr[] = $empOfficeInfo->mobile_number;
            }


            return response()->json([
                'status' => 'success',
                'data' => $getOfficeInfo,
                'phonedata' => $phoneNumberArr

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
     *     tags={"PDS Send Message"},
     *     path="/pds-backend/api/getPhoneNumberById/{id}",
     *     operationId="getPhoneNumberById",
     *     summary="getPhoneNumberById",
     *     @OA\Parameter(name="id", description="id", example=1, required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Success"),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     security={{"bearer_token":{}}}
     * )
     */

    public function getPhoneNumberById(Request $request, $id)
    {
        try {
            $getOfficeInfo = Employee::leftJoin('offices', 'offices.id', '=', 'employees.office')
                ->select(
                    'employees.mobile_number',
                )
                ->where('employees.id', $id)
                ->get();
            return response()->json([
                'status' => 'success',
                'data' => $getOfficeInfo,

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
     *     tags={"PDS Send Message"},
     *     path="/pds-backend/api/getMessageInfo",
     *     operationId="getMessageInfo",
     *     summary="getMessageInfo",
     *      @OA\Parameter(
     *         name="department",
     *         in="query",
     *         description="Department",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="designations",
     *         in="query",
     *         description="Designation",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="offices",
     *         in="query",
     *         description="office",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="mobile_number",
     *         in="query",
     *         description="Mobile number",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response=200, description="Success"),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     security={{"bearer_token":{}}}
     * )
     */



    public function getMessageInfo(Request $request)
    {
        try {

            $getMessageInfo = Employee::leftJoin('departments', 'departments.id', '=', 'employees.department')
                ->leftJoin('designations', 'designations.id', '=', 'employees.designation')
                ->leftJoin('offices', 'offices.id', '=', 'employees.office')
                ->select(
                    'employees.id',
                    'employees.name',
                    'employees.mobile_number',
                    'designations.id as designation_id',
                    'designations.designation_name as designation_name',
                    'departments.id as department_id',
                    'departments.dept_name as department_name',
                    'offices.id as office_id',
                    'offices.office_name as office_name'

                )->orderBy('employees.id', 'ASC');

            if (!empty($request->department)) {
                $getMessageInfo = $getMessageInfo->where('employees.department', $request->department);
            }

            if (!empty($request->designations)) {
                $getMessageInfo = $getMessageInfo->where('employees.designation', $request->designations);
            }
            if (!empty($request->offices)) {
                $getMessageInfo = $getMessageInfo->where('employees.office', $request->offices);
            }

            if (!empty($request->employee_id)) {
                $getMessageInfo = $getMessageInfo->where('employees.id', $request->employee_id);
            }

            $getMessageInfo = $getMessageInfo->get();

            $departmentList = [];
            $designnationList = [];
            $officeList = [];
            $phoneList = [];

            foreach ($getMessageInfo as $item) {
                if (!is_null($item->department_name)) {
                    $departmentList[$item->department_id] =  $item->department_name;
                }
                if (!is_null($item->designation_name)) {
                    $designnationList[$item->designation_id] =  $item->designation_name;
                }
                if (!is_null($item->office_name)) {
                    $officeList[$item->office_id] =  $item->office_name;
                }
                if (!is_null($item->mobile_number) && $item->mobile_number !== 0) {
                    $phoneList[] =  $item->mobile_number;
                }
            }


            return response()->json([
                'status' => 'success',
                'departmentList'   => $departmentList,
                'designnationList'   => $designnationList,
                'officeList'   => $officeList,
                'phoneList'   => $phoneList,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
