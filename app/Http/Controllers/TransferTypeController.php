<?php

namespace App\Http\Controllers;

use App\Models\TransferType;
use Illuminate\Http\Request;


/**
 * @OA\Get(
 * tags={"PDS Transfer Type"},
 * path= "/pds-backend/api/getTransferType",
 * operationId="getTransferType",
 * summary="Transfer Type List",
 * description="Transfer Type List",
 * @OA\Response(response=200, description="Success" ),
 * @OA\Response(response=400, description="Bad Request"),
 * @OA\Response(response=404, description="Resource Not Found"),
 * ),
 * security={{"bearer_token":{}}}
 */
class TransferTypeController extends Controller

{

    protected $responseRepository;
    public function __construct(ResponseRepository $rp,)
    {
        //$this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rp;
    }
    public function getTransferType()
    {

        try {

            $getTransferType = TransferType::get();
            return response()->json([
                'status' => 'success',
                'list' => $getTransferType,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }
}
