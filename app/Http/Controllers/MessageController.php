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
            $rules = [
                'subject' => 'required',
                'phone' => 'required',
                'designation' => 'required',
                'office' => 'required',
                'from' => 'required',
                'message' => 'required',

            ];

            $messages = [
                'subject.required' => 'The subject field is required',
                'phone.required' => 'The phone field is required',
                'office.required' => 'The office field is required',
                'designation.required' => 'The designation_name field is required',
                'from.required' => 'The from field is required',
                'message.required' => 'The message field is required',

            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return $this->responseRepository->ResponseError(null, $validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }





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
}
