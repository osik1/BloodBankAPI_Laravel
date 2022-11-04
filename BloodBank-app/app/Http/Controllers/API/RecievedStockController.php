<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\recievedStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\recievedStockResource;

class RecievedStockController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $recievedStocks = recievedStock::all();
        return $this->sendResponse(recievedStockResource::collection($recievedStocks), 'Recieved Stocks retrieved successfully.');
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
     * Fetch all blood requests from the blood request controller with a status of 2 and Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'bloodRequest_id' => 'required',
            'bloodType_id' => 'required',
            'user_id' => 'required',
            'quantity' => 'required',
            'status' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $recievedStock = recievedStock::create($input);
        return $this->sendResponse(new recievedStockResource($recievedStock), 'Recieved Stock created successfully.');
    }


  

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\recievedStock  $recievedStock
     * @return \Illuminate\Http\Response
     */
    public function show(recievedStock $recievedStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\recievedStock  $recievedStock
     * @return \Illuminate\Http\Response
     */
    public function edit(recievedStock $recievedStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\recievedStock  $recievedStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, recievedStock $recievedStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\recievedStock  $recievedStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(recievedStock $recievedStock)
    {
        //
    }
}
