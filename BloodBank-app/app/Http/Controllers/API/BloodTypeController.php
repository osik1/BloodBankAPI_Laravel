<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\bloodType;
// use Validator;
use App\Http\Resources\bloodTypeResource;
use Illuminate\Support\Facades\Validator;


class BloodTypeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bloodTypes = bloodType::all();
        return $this->sendResponse(bloodTypeResource::collection($bloodTypes), 'Blood Types retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'name' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $bloodType = bloodType::create($input);
        return $this->sendResponse(new bloodTypeResource($bloodType), 'Blood Type created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bloodType  $bloodType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bloodType = bloodType::find($id);

        if (is_null($bloodType)) {
            return $this->sendError('Blood Type not found.');
        }
        return $this->sendResponse(new bloodTypeResource($bloodType), 'Blood Type retrieved successfully.');
    }
    

      /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */

    public function edit(bloodType $bloodType)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\bloodType  $bloodType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, bloodType $bloodType)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $bloodType->name = $input['name'];
        $bloodType->save();
        return $this->sendResponse(new bloodTypeResource($bloodType), 'Blood Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  \App\Models\bloodType  $bloodType   
        * @return \Illuminate\Http\Response
        */

    public function destroy($id)
    {
        $bloodType = bloodType::find($id);
        if (is_null($bloodType)) {
            return $this->sendError('Blood Type not found.');
        }
        $bloodType->delete();
        return $this->sendResponse([], 'Blood Type deleted successfully.');
    }
}