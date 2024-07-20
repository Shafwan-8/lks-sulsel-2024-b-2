<?php

namespace App\Http\Controllers;

use App\Models\Destinations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DestinationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Destinations::all();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->request->add(['user_id' => auth()->user()->id]);

        $tervalidasi = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'user_id' => 'required',
            'description' => 'required|min:3',
        ]);

        if($tervalidasi->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'error' => $tervalidasi->errors(),
            ], 201);
        }
        else
        {
            $data = $tervalidasi->validated();

            Destinations::create($data);

            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $data,
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Destinations $destinations, $id)
    {
        $data = $destinations->where('id', $id)->first();

        if($data)
        {
            $data->delete();
    
            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $data
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'data not found',
                'data' => null
            ], 201);
        }
        

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destinations $destinations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destinations $destinations, $id)
    {

        $tervalidasi = Validator::make($request->all(), [
            'name' => '',
            'description' => ''
        ]);

        if($tervalidasi->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'error' => $tervalidasi->errors(),
            ], 201);
        }
        else
        {
            $data1 = $tervalidasi->validated();
            
            $data = $destinations->where('id', $id)->first();
    
            if(!$data)
            {
                return response()->json([
                    'status' => false,
                    'message' => 'data not found',
                    'data' => null
                ], 201);
            }

            $data->update($data1);

            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $data,
            ], 200);
        }



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destinations $destinations, $id)
    {
        $data = $destinations->where('id', $id)->first();


        if($data)
        {
            $data->delete();
    
            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => null
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'data not found',
                'data' => null
            ], 201);
        }

    }
}
