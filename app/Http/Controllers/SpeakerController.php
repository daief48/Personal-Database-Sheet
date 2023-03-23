<?php

namespace App\Http\Controllers;
use App\Repositories\ResponseRepository;
use App\Models\Speaker;
use App\Models\Event;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Image;

class SpeakerController extends Controller
{
    protected $responseRepository;
    public function __construct(ResponseRepository $rr,)
    {
        $this->middleware('auth:api', ['except' => []]);
        $this->responseRepository = $rr;
    }


    /**
    * @OA\Get(
    * tags={"ASF Speaker"},
    * path="/asfBackend/api/getSpeaker",
    * operationId="getSpeaker",
    * summary="Get Speakers List",
    * description="Get Speaker Details",
    * @OA\Response(response=200, description="Success" ),
    * @OA\Response(response=400, description="Bad Request"),
    * @OA\Response(response=404, description="Resource Not Found"),
    * ),
    * security={{"bearer_token":{}}}
    */

    public function getSpeaker(Request $request){
        try {
            $eventTitle = Event::select('id','title')->where('status','=',1)->first();
            $activeEvent = $eventTitle->id;

            $getSpeaker = Speaker::where('event_id','=',$activeEvent)->orderBy('order','ASC')->get();

            return response()->json([
                'status' => 'success',
                'list' => $getSpeaker,
                'activeTitle' =>$eventTitle
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
    * tags={"ASF Speaker"},
    * path="/asfBackend/api/addSpeaker",
    * operationId="addSpeaker",
    * summary="Add Speaker",
    * description="Add Speaker",
    *     @OA\RequestBody(
    *         @OA\JsonContent(),
    *         @OA\MediaType(
    *            mediaType="multipart/form-data",
    *            @OA\Schema(
    *               type="object",
    *               required={"name", "status"},
    *               @OA\Property(property="name", type="text"),
    *               @OA\Property(property="image", type="text"),
    *               @OA\Property(property="occupation", type="text"),
    *               @OA\Property(property="organization", type="text"),
    *               @OA\Property(property="social_link", type="text"),
    *               @OA\Property(property="bio", type="text"),
    *               @OA\Property(property="status", type="integer"),
    *            ),
    *        ),
    *    ),
    *      @OA\Response(
    *          response=200,
    *          description="Speaker Added Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * ),
    *     security={{"bearer_token":{}}}
    */



    public function addSpeaker(Request $request){

        try {

            // $request->validate([
            //     'name' => 'required|string|max:255',
            //     'image' => '',
            //     'occupation' => '',
            //     'organization' => '',
            //     'social_link' => '',
            //     'bio' => '',
            //     'status' => 'required|integer'
            // ]);


            // $addSpeaker = Speaker::create([

            //     'name' => $request->name,
            //     'image' => $request->image,
            //     'occupation' => $request->occupation,
            //     'organization' => $request->organization,
            //     'social_link' => $request->social_link,
            //     'bio' => $request->bio,
            //     'status' => $request->status,


            // ]);

            $eventId =  Event::select('id')->where('status','=',1)->first();
            $eventId = $eventId->id;

            $updateSpeaker = new Speaker;
            $updateSpeaker->name = $request->name;
            $updateSpeaker->occupation = $request->occupation ?? '';
            $updateSpeaker->organization = $request->organization ?? '';
            $updateSpeaker->social_link = $request->social_link ?? '';
            $updateSpeaker->details = $request->details ?? '';
            $updateSpeaker->status = $request->status;
            $updateSpeaker->event_id = $eventId;
            $updateSpeaker->order = $request->order ?? 0;

            if ($request->image) {
                $speaker_image_name = 'speaker_image_' . time() . '.png';
                Image::make($request->image)->save(public_path('uploads/images/speakers/'.$speaker_image_name));
                $updateSpeaker->image = $speaker_image_name;
            }
            $updateSpeaker->save();

            return $this->responseRepository->ResponseSuccess($updateSpeaker, "Success", 200);

        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function searchSpeaker(Request $request)
    {
        try {
            $eventTitle = Event::select('id','title')->where('status','=',1)->first();
            $activeEvent = $eventTitle->id;

            $perPage = isset($request->perPage) ? intval($request->perPage) : 10;
            $data =  Speaker::where('event_id','=',$activeEvent);

            $searchText = $request->search;

            if (!empty($searchText)) {
                $data->where(function ($query) use ($searchText) {
                    $query->where('name', 'LIKE', '%' . $searchText . '%');
                    $query->orWhere('occupation', 'LIKE', '%' . $searchText . '%');
                });
            }

            $data = $data->orderBy('id', 'desc')
                 ->paginate(10);

            return response()->json([
                'status'  => true,
                'message' => "Speaker list get successfully",
                'errors'  => null,
                'data'    => $data,
                'eventTitle' =>$eventTitle
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
    * tags={"ASF Speaker"},
    * path="/asfBackend/api/getSpeakerDetail/{id}",
    * operationId="getSpeakerDetail",
    * summary="Get Specific Speaker Detail",
    * @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="integer")),
    * @OA\Response(response=200, description="Success" ),
    * @OA\Response(response=400, description="Bad Request"),
    * @OA\Response(response=404, description="Resource Not Found"),
    * ),
    * security={{"bearer_token":{}}}
    */

    public function getSpeakerDetail(Request $request){
        try {
            $getSpeakerDetail = Speaker::findOrFail($request->id);
            return response()->json([
                'status' => 'success',
                'speakerDetail' => $getSpeakerDetail,
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }



/**
    * @OA\Put(
    * tags={"ASF Speaker"},
    * path="/asfBackend/api/updateSpeaker/{id}",
    * operationId="updateSpeaker",
    * summary="Update Speaker",
    * @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
    * @OA\RequestBody(
    *          @OA\JsonContent(
    *              type="object",
    *              required={"name", "status"},
    *              @OA\Property(property="name", type="string"),
    *              @OA\Property(property="image", type="string"),
    *              @OA\Property(property="occupation", type="string"),
    *              @OA\Property(property="organization", type="string"),
    *              @OA\Property(property="social_link", type="string"),
    *              @OA\Property(property="bio", type="string"),
    *              @OA\Property(property="status", type="integer"),
    *          ),
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Speaker Updated Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * ),
    *     security={{"bearer_token":{}}}
    */


    public function updateSpeaker($id, Request $request){

        try {
            // $request->validate([
            //     'name' => 'required|string|max:255',
            //     'image' => 'string',
            //     'occupation' => '',
            //     'organization' => '',
            //     'social_link' => '',
            //     'bio' => '',
            //     'status' => 'required|integer'

            // ]);


           $updateSpeaker = Speaker::findOrFail($id);

            $updateSpeaker->name = $request->name;
            $updateSpeaker->occupation = $request->occupation ?? '';
            $updateSpeaker->organization = $request->organization ?? '';
            $updateSpeaker->social_link = $request->social_link ?? '';
            $updateSpeaker->details = $request->details ?? '';
            $updateSpeaker->status = $request->status;
            $updateSpeaker->order = $updateSpeaker->order;

            if ($request->image) {
                $speaker_image_name = 'speaker_image_' . time() . '.png';
                Image::make($request->image)->save(public_path('uploads/images/speakers/') . $speaker_image_name);
                $updateSpeaker->image = $speaker_image_name;
            }


            $updateSpeaker->save();



            return response()->json([
                'status'  => true,
                'message' => "Speaker updated successfully",
                'errors'  => null,
                'data'    =>$updateSpeaker,
            ], 200);

        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


      /**
     * @OA\Delete(
     *     path="/asfBackend/api/deleteSpeaker/{id}",
     *     tags={"ASF Speaker"},
     *     summary="Delete Speaker",
     *     description="Delete Speaker ID",
     *     operationId="deleteSpeaker",
     *     @OA\Parameter(name="id", description="id", example = 1, required=true, in="path", @OA\Schema(type="string")),
     *     @OA\Response( response=200, description="Successfully, Delete Employee" ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * ),
     *     security={{"bearer_token":{}}}
     */

    public function deleteSpeaker($id)
    {
        try {
            $deleteSpeaker =  Speaker::findOrFail($id);
            $deleteSpeaker->delete();

            return response()->json([
                'status'  => true,
                'message' => "Speaker deleted successfully",
                'errors'  => null,
                'data'    => $deleteSpeaker,
            ], 200);

        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function getAllSpeaker(){
        try {
            $getSpeaker = Speaker::orderBy('id','desc')->get();
            return response()->json([
                'status' => 'success',
                'list' => $getSpeaker,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }





















}
