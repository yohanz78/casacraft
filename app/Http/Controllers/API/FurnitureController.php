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
     *      ),
     *      @OA\Parameter(
     *          name="_page",
     *          in="query",
     *          description="current page",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64",
     *              example=1
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="_limit",
     *          in="query",
     *          description="max item in a page",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64",
     *              example=10
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="_search",
     *          in="query",
     *          description="word to search",
     *          required=false,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="_vendor",
     *          in="query",
     *          description="search by vendor",
     *          required=false,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="_sort_by",
     *          in="query",
     *          description="word to search",
     *          required=false,
     *          @OA\Schema(
     *              type="string",
     *              example="latest"
     *          )
     *      ),
     *  )
     */
    public function index(Request $request)
    {
        try {
            $data['products']   = Furniture::whereRaw('1 = 1');
            $data['filter']     = $request->all();
            $page               = $data['filter']['_page'] = (@$data['filter']['_page'] ? intval($data['filter']['_page']) : 1);
            $limit              = $data['filter']['_limit'] = (@$data['filter']['_limit'] ? intval($data['filter']['_limit']) : 1000);
            $offset             = ($page ? ($page - 1) * $limit : 0);

            if ($request->get('_search')) {
                $data['products'] = $data['products']->whereRaw('(LOWER(name) LIKE "'.strtolower($request->get('_search')).'%" OR LOWER (vendora) LIKE "%'.strtolower($request->get('_search')).'%")');
            }
            if ($request->get('_vendor')) {
                $data['products'] = $data['products']->whereRaw('LOWER(vendor) LIKE "'.strtolower($request->get('_vendor')).'"');
            }
            if ($request->get('_sort_by')) {
                switch ($request->get('_sort_by')) {
                    default:
                    case 'latest_added':
                        $data['products'] = $data['products']->orderBy('created_at', 'DESC');
                        break;
                    case 'name_asc':
                        $data['products'] = $data['products']->orderBy('name', 'ASC');
                        break;
                    case 'name_desc':
                        $data['products'] = $data['products']->orderBy('name', 'DESC');
                        break;
                    case 'price_asc':
                        $data['products'] = $data['products']->orderBy('price', 'ASC');
                        break;
                    case 'price_desc':
                        $data['products'] = $data['products']->orderBy('price', 'DESC');
                        break;
                }
            }
            $data['products_count_total']   = $data['products']->count();
            $data['products']               = ($limit == 0 && $offset == 0) ? $data['products'] : $data['products']->limit($limit)->offset($offset);
            // $data['products']               = $data['products']->toSql();
            $data['products']               = $data['products']->get();
            $data['products_count_start']   = ($data['products_count_total'] == 0 ? 0 : (($page - 1) * $limit) + 1);
            $data['products_count_end']     = ($data['products_count_total'] == 0 ? 0 : (($page - 1) * $limit) + sizeof($data['products']));

            return response()->json($data, 200);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data: {$exception->getMessage()}");
        }
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
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Furniture",
     *              example={"name": "Lorem Ipsum", "description": "Lorem ipsum dolor sit amet",
     *              "image": "https://", "price": "100000", "category": "Table", "vendor": "Brand",}
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
            'price' => $request->price,
            'category' => $request->category,
            'vendor' => $request->vendor
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
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Furniture",
     *              example={"name": "Lorem Ipsum", "description": "Lorem ipsum dolor sit amet",
     *              "image": "https://", "price": "100000", "category": "Table", "vendor": "Brand",}
     *          )
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
                'category' =>  'required',
                'vendor' =>  'required'
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
