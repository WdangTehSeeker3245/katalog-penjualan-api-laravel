<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
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
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'id_kategori' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            // Add validation rules for other fields
        ]);

        // If validation fails, return the validation errors
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Create a new instance of YourModel
            $model = new Product;

            // Set the model properties with the request data
            $model->nama = $request->input('nama');
            $model->id_kategori = $request->input('id_kategori');
            $model->harga = $request->input('harga');
            $model->deskripsi = $request->input('deskripsi');
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'id_kategori' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            // Add validation rules for other fields
        ]);

        // If validation fails, return the validation errors
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Find the model instance by ID
            $model = Product::findOrFail($id);

            // Update the model properties with the request data
            $model->nama = $request->input('nama');
            $model->id_kategori = $request->input('id_kategori');
            $model->harga = $request->input('harga');
            $model->deskripsi = $request->input('deskripsi');
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Find the model instance by ID
            $model = Product::findOrFail($id);
    
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
