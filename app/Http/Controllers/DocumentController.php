<?php

namespace App\Http\Controllers;

use App\Repositories\ResponseRepository;
use App\Models\Document;
use App\Models\Event;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use File;
use Image;

class DocumentController extends Controller
{
    protected $responseRepository;
    public function __construct(ResponseRepository $rr)
    {
        $this->middleware('auth:api', ['except' => ['getAllDocument', 'addDocument']]);
        $this->responseRepository = $rr;
    }
}
