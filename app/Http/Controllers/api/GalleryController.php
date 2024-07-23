<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Gallery::all();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $request->request->add(['user_id' => auth()->user()->id]);

        $tervalidasi = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required',
            'description' => 'required'
        ]);

        if ($tervalidasi->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'data' => $tervalidasi->errors()
            ], 201);
        }
        else
        {
            $data = $tervalidasi->validated();

            Gallery::create($data);

            return response()->json([
                'status' => true,
                'nessage' => 'success',
                'data' => $data
            ], 200);

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Gallery::where('id', $id)->first();

        if (is_null($data))
        {
            return response()->json([
                'status' => false,
                'message' => 'data not found',
                'data' => null
            ], 201);
        }
        
        $tervalidasi = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);

        if ($tervalidasi->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'validator error',
                'data' => $tervalidasi->errors()
            ], 201);
        }
        else
        {
            $new_data = $tervalidasi->validated();

            $data->update($new_data);

            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $new_data
            ], 200);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Gallery::where('id', $id)->first();

        if (is_null($data))
        {
            return response()->json([
                'status' => false,
                'message' => 'Data not found!',
                'data' => null
            ]);
        }
        else
        {
            $data->delete();

            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => null
            ]);
        }
    }
}
