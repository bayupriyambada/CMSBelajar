<?php

namespace App\Http\Controllers;

use App\Models\RolesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $getRoles = RolesModel::query();
        $nameQuery = $request->query('queryName');
        $getRoles->when($nameQuery, function ($query) use ($nameQuery) {
            return $query->whereRaw("name LIKE '%" . strtolower($nameQuery) . "%'");
        });
        return response()->json([
            'message' => 'Success',
            'data' => $getRoles->get()
        ], 200);
    }
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validation->errors()
            ]);
        }

        $storeRoles = RolesModel::create([
            'name' => $request->name
        ]);
        return response()->json([
            'status' => 'success',
            'data' => $storeRoles
        ], 200);
    }
    // public function show(Request $request, $id)
    // {
    //     $dataId = $request->query('dataId');
    //     dd($dataId);
    //     $showRolesId = RolesModel::findOrFail($id);
    //     dd($showRolesId);
    //     // $queryIds = $request->query('id', $id);
    //     // dd($queryIds);
    //     // $queryId = $request->query('id', $id);
    //     // if ($queryId) {
    //     //     $getId = RolesModel::find($queryId);
    //     //     dd($getId);
    //     //     if ($getId) {
    //     //         return response()->json([
    //     //             'status' => 'success',
    //     //             'message' => $getId
    //     //         ], 200);
    //     //     }
    //     //     return response()->json([
    //     //         'status' => 'success',
    //     //         'message' => 'Data not found'
    //     //     ], 404);
    //     // }

    //     // $showRoles = RolesModel::get();
    //     // // If there is data, return it
    //     // if ($showRoles->isNotEmpty()) {
    //     //     return response()->json([
    //     //         'success' => true,
    //     //         'data' => $showRoles,
    //     //     ]);
    //     // }

    //     // // If there is no data, return an error message
    //     // return response()->json([
    //     //     'success' => false,
    //     //     'message' => 'No data found.',
    //     // ]);
    // }

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
