<?php

namespace App\Http\Controllers\Api;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();
        return response()->json($statuses, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newStatus = new Status();
        try {
            $newStatus = Status::create($request->only($newStatus->getFillable()));
            return response()->json([
                'message' => 'Status created successfully!',
                'data' => $newStatus
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error saving the status :(',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        return response()->json($status, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        try {
            $updatedStatus = new Status();
            $status->update($request->only($updatedStatus->getFillable()));
            return response()->json([
                'message' => 'Status updated successfully! :)',
                'data' => $status
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error udpating the status :('
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        try {
            $status->delete();
            return response()->json([
                'message' => 'Status removed successfully :)',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error removing the status :('
            ], 500);
        }
    }
}
