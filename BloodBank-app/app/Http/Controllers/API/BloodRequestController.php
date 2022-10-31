<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\bloodRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\bloodRequestResource;

class BloodRequestController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        $bloodRequests = bloodRequest::all();
        return $this->sendResponse(bloodRequestResource::collection($bloodRequests), 'Blood Requests retrieved successfully.');
    }
    




    /**
     * Display all listing of the resources for a specific facility that is approved.
     */
    
    public function facilityApproved($id)
    {
        $bloodRequests = bloodRequest::where('facility_id', $id)->where('status', 1)->get();
        return $this->sendResponse(bloodRequestResource::collection($bloodRequests), 'Blood Requests retrieved successfully.');
    }


    
    /**
     * Display all listing of the resources for a specific facility that is pending.
     */
    public function facilityPending($id)
    {
        $bloodRequests = bloodRequest::where('facility_id', $id)->where('status', 0)->get();
        return $this->sendResponse(bloodRequestResource::collection($bloodRequests), 'Blood Requests retrieved successfully.');
    }


    /**
     * Display all listing of the resources for a specific Blood Request made by the logged in user.
    */
    public function userBloodRequests($id)
    {
        $bloodRequests = bloodRequest::where('user_id', $id)->get();
        return $this->sendResponse(bloodRequestResource::collection($bloodRequests), 'Blood Requests retrieved successfully.');
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
            'facility_id' => 'required',
            'blood_type_id' => 'required',
            'quantity' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $bloodRequest = bloodRequest::create($input);
        return $this->sendResponse(new bloodRequestResource($bloodRequest), 'Blood Request sent successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bloodRequest  $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $bloodRequest = bloodRequest::find($id);
        if (is_null($bloodRequest)) {
            return $this->sendError('Blood Request not found.');
        }
        return $this->sendResponse(new bloodRequestResource($bloodRequest), 'Blood Request retrieved successfully.');
    }
    

    /**
     * Display the specified resource by the ref_code.
     */
    public function showByRefCode($ref_code)
    {
        //
        $bloodRequest = bloodRequest::where('ref_code', $ref_code)->first();
        if (is_null($bloodRequest)) {
            return $this->sendError('Blood Request not found.');
        }
        return $this->sendResponse(new bloodRequestResource($bloodRequest), 'Blood Request retrieved successfully.');
    }
    

    /**
     * Display all the specified resoure by the facility_id.
     */
    public function showByFacility($facility_id)
    {
        //
        $bloodRequests = bloodRequest::where('facility_id', $facility_id)->get();
        if (is_null($bloodRequests)) {
            return $this->sendError('No blood request found.');
        }
        return $this->sendResponse(bloodRequestResource::collection($bloodRequests), 'Blood Request retrieved successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bloodRequest  $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(bloodRequest $bloodRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage by id.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\bloodRequest  $bloodRequest
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        //
        $input = $request->all();

        $validator = Validator::make($input, [
            'facility_id' => 'required',
            'blood_type_id' => 'required',
            'quantity' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $bloodRequest = bloodRequest::find($id);
        $bloodRequest->facility_id = $input['facility_id'];
        $bloodRequest->blood_type_id = $input['blood_type_id'];
        $bloodRequest->quantity = $input['quantity'];
        $bloodRequest->save();
        return $this->sendResponse(new bloodRequestResource($bloodRequest), 'Blood Request updated successfully.');
    }

    

    /**
     * Approve the specified resource in storage by id
     */
     public function approve($id)
     {
            //
            $bloodRequest = bloodRequest::find($id);
            $bloodRequest->status = 1;
            $bloodRequest->save();
            return $this->sendResponse(new bloodRequestResource($bloodRequest), 'Blood Request approved successfully.');
     }

    

     /**
      * Disapprove the specified resource in storage by id
      */
        public function disapprove($id)
        {
            //
            $bloodRequest = bloodRequest::find($id);
            $bloodRequest->status = 0;
            $bloodRequest->save();
            return $this->sendResponse(new bloodRequestResource($bloodRequest), 'Blood Request disapproved successfully.');
        }





    /**
     * Remove the specified resource from storage by id.
     *
     * @param  \App\Models\bloodRequest  $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $bloodRequest = bloodRequest::find($id);
        if (is_null($bloodRequest)) {
            return $this->sendError('Blood Request not found.');
        }
        $bloodRequest->delete();
        return $this->sendResponse([], 'Blood Request deleted successfully.');
    }
}
