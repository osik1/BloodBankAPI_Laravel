<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\facilityResource;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $facilities = Facility::all();
       return $this->sendResponse(facilityResource::collection($facilities), 'Facilities retrieved successfully.'); 
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
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'city' => 'required',
            'region' => 'required',
            'gps' => 'required',
           
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $facility = Facility::create($input);
        return $this->sendResponse(new facilityResource($facility), 'Facility created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $facility = Facility::find($id);
        if (is_null($facility)) {
            return $this->sendError('Facility not found.');
        }
        return $this->sendResponse(new facilityResource($facility), 'Facility retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function edit(Facility $facility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facility $facility)
    {
        //
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'city' => 'required',
            'region' => 'required',
            'gps' => 'required',
           
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $facility->name = $input['name'];
        $facility->address = $input['address'];
        $facility->phone = $input['phone'];
        $facility->email = $input['email'];
        $facility->city = $input['city'];
        $facility->region = $input['region'];
        $facility->gps = $input['gps'];
        $facility->save();
        return $this->sendResponse(new facilityResource($facility), 'Facility updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $facility = Facility::find($id);
        if (is_null($facility)) {
            return $this->sendError('Facility not found.');
        }
        $facility->delete();
        return $this->sendResponse([], 'Facility deleted successfully.');
    }
}
