<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Furniture;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class FurnitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Furniture::get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $furniture = new Furniture;
            $furniture->fill($request->validated())->save();

            return $furniture;
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $furniture = Furniture::findOrfail($id);

        return $furniture;
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
        if (!$id) {
            throw new HttpException(400, "Error Processing Request");
        }

        try {
            $furniture = Furniture::find($id);
            $furniture->fill($$request->validated())->save();

            return $furniture;
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $furniture = Furniture::findOrfail($id);
        $furniture->delete();

        return response()->json(null, 204);
    }
}
