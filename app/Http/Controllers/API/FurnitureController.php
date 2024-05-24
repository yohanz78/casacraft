<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Furniture;
use OpenApi\Annotations\OpenApi as OA;


class FurnitureController extends Controller
{
    /**
     *  @OA\Get(
     *      path="/api/furniture",
     *      tags={"furniture"},
     *      summary="Display a listing of items",
     *      operationId="index",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *      )
     *  )
     */
    public function index()
    {
        return Furniture::get();
    }

    /**
     *  @OA\Post(
     *      path="/api/furniture",
     *      tags={"furniture"},
     *      summary="Create item",
     *      operationId="store",
     *      @OA\Response(
     *          response=201,
     *          description="Successful",
     *          @OA\JsonContent()
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Furniture")
     *          )
     *      ),
     *      security={{"passport_token_ready":{},"passport":{}}}
     *  )
     */
    public function store(Request $request)
    {
        $furniture = Furniture::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
            'price' => $request->price
        ]);
        return response()->json([
            'data' => $furniture
        ]);
    }

    /**
     *  @OA\Get(
     *      path="/api/furniture/{id}",
     *      tags={"furniture"},
     *      summary="Display the specified item",
     *      operationId="show",
     *      @OA\Response(
     *          response=404,
     *          description="Item not found",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid input",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of item that needs to be displayed",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      )
     *  )
     */
    public function show($id)
    {
        $furniture = Furniture::findOrfail($id);
        if (!$furniture) {
            throw new HttpException("Item not found", 404);
        }
        return $furniture;
    }

    /**
     *  @OA\Put(
     *      path="/api/furniture/{id}",
     *      tags={"furniture"},
     *      summary="Update the specified item",
     *      operationId="update",
     *      @OA\Response(
     *          response=404,
     *          description="Item not found",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="invalid input",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of item that needs to be updated",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Request body description",
     *          @OA\JsonContent(ref="#/components/schemas/Furniture")
     *      ),
     *      security={{"passport_token_ready":{},"passport":{}}}
     *  )
     */
    public function update(Request $request, string $id)
    {
        $furniture = Furniture::find($id);
        if (!$id) {
            throw new HttpException("Item not found", 400);
        }

        try {
            $validator = Validator::make($request->all(), [
                'name'  =>  'required',
                'price' =>  'required',
            ]);
            if ($validator->fails()) {
                throw new HttpException($validator->message()->first(), 400);
            };
            $furniture->fill($$request->validated())->save();
            return response()->json(array('message' => 'Updated Successfully'), 200);
        } catch (\Exception $exception) {
            throw new HttpException("Invalid data - {$exception->getMessage()}", 400);
        }
    }

    /**
     *  @OA\Delete(
     *      path="/api/furniture/{id}",
     *      tags={"furniture"},
     *      summary="Remove the specified item",
     *      operationId="destroy",
     *      @OA\Response(
     *          response=404,
     *          description="Item not found",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid input",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of item that needs to be removed",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      security={{"passport_token_ready":{},"passport":{}}}
     *  )
     */
    public function destroy(string $id)
    {
        $furniture = Furniture::findOrfail($id);
        if (!$furniture) {
            throw new HttpException('Item not found', 404);
        }
        try {
            $furniture->delete();
            return response()->json(array('message' => 'Deleted successfully'), 200);
        } catch (\Exception $exception) {
            throw new HttpException("Invalid data : {$exception->getMessage()}", 400);
        }

        return response()->json(null, 204);
    }
}
