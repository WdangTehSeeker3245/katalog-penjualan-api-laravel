<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePenjualanRequest;
use App\Http\Requests\UpdatePenjualanRequest;
use App\Models\Penjualan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Penjualan::all();
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
     * @param  \App\Http\Requests\StorePenjualanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenjualanRequest $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'tanggal'=> 'required',
            'id_product'=> 'required',
            'jumlah' => 'required',
            // Add validation rules for other fields
        ]);

        // If validation fails, return the validation errors
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Create a new instance of YourModel
            $model = new Penjualan;

            // Set the model properties with the request data
            $model->tanggal = $request->input('tanggal');
            $model->id_product = $request->input('id_product');
            $model->jumlah = $request->input('jumlah');
            // Set other fields

            // Save the model
            $model->save();

            // Return a success response
            return response()->json(['message' => 'Data inserted successfully'], 201);
        } catch (QueryException $e) {
            // Handle database exceptions
            return response()->json(['error' => 'Failed to insert data'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Penjualan::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenjualanRequest  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenjualanRequest $request, $id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'tanggal'=> 'required',
            'id_product'=> 'required',
            'jumlah' => 'required',
            // Add validation rules for other fields
        ]);

        // If validation fails, return the validation errors
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Find the model instance by ID
            $model = Penjualan::findOrFail($id);

            // Update the model properties with the request data
            $model->tanggal = $request->input('tanggal');
            $model->id_product = $request->input('id_product');
            $model->jumlah = $request->input('jumlah');

            // Update other fields

            // Save the updated model
            $model->save();

            // Return a success response
            return response()->json(['message' => 'Data updated successfully'], 200);
        } catch (QueryException $e) {
            // Handle database exceptions
            return response()->json(['error' => 'Failed to update data'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Find the model instance by ID
            $model = Penjualan::findOrFail($id);
    
            // Delete the model
            $model->delete();
    
            // Return a success response
            return response()->json(['message' => 'Data deleted successfully'], 200);
        } catch (QueryException $e) {
            // Handle database exceptions
            return response()->json(['error' => 'Failed to delete data'], 500);
        }
    }
}
