<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\openBloodRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\openBloodRequestResource;

class OpenBloodRequestController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $openBloodRequests = openBloodRequest::all();
        return $this->sendResponse(openBloodRequestResource::collection($openBloodRequests), 'Open Blood Requests retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();
        $validator = Validator::make($input, [
            'blood_type_id' => 'required',
            'user_id' => 'required',
            'quantity' => 'required',
            'status' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $openBloodRequest = openBloodRequest::create($input);
        return $this->sendResponse(new openBloodRequestResource($openBloodRequest), 'Open Blood Request created successfully.');

    }

    /**
     * Display the specified resource by id.
     *
     * @param  \App\Models\openBloodRequest  $openBloodRequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $openBloodRequest = openBloodRequest::find($id);
        if (is_null($openBloodRequest)) {
            return $this->sendError('Open Blood Request not found.');
        }
        return $this->sendResponse(new openBloodRequestResource($openBloodRequest), 'Open Blood Request retrieved successfully.');
    }
    

    /**
     * Display the specified resource by user id.
     */
    public function showByUser($id)
    {
        //
        $openBloodRequests = openBloodRequest::where('user_id', $id)->get();
        return $this->sendResponse(openBloodRequestResource::collection($openBloodRequests), 'Open Blood Requests retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\openBloodRequest  $openBloodRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(openBloodRequest $openBloodRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage by id.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\openBloodRequest  $openBloodRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input = $request->all();
        $validator = Validator::make($input, [
            'blood_type_id' => 'required',
            'user_id' => 'required',
            'quantity' => 'required',
            'status' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $openBloodRequest = openBloodRequest::find($id);
        $openBloodRequest->blood_type_id = $input['blood_type_id'];
        $openBloodRequest->user_id = $input['user_id'];
        $openBloodRequest->quantity = $input['quantity'];
        $openBloodRequest->status = $input['status'];
        $openBloodRequest->save();
        return $this->sendResponse(new openBloodRequestResource($openBloodRequest), 'Open Blood Request updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage by id.
     *
     * @param  \App\Models\openBloodRequest  $openBloodRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $openBloodRequest = openBloodRequest::find($id);
        $openBloodRequest->delete();
        return $this->sendResponse([], 'Open Blood Request deleted successfully.');
    }
   
}
