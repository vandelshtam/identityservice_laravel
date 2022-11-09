<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Product;
use Illuminate\Http\Response;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

/**
 * Class RoleControllerController
 * @package  App\Http\Controllers
 */
class RoleController extends Controller
{
    /**
     * @OA\Get(
     *  path="/roles",
     *  operationId="indexRole",
     *  tags={"Roles"},
     *  summary="Get list of Roles",
     *  description="Returns list of Role",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Roles"),
     *  ),
     * )
     *
     * Display a listing of Product.
     * @return JsonResponse
     */
    public function index()
    {
        $roles = Role::all();
        return response()->json(['data' => $roles]);
    }

    /**
     * @OA\Post(
     *  operationId="storeRole",
     *  summary="Insert a new Role",
     *  description="Insert a new Role",
     *  security={{ "bearerAuth": {} }},
     *  tags={"Roles"},
     *  path="/roles",
     *  @OA\RequestBody(
     *    description="Role to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Role")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Role created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Role"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param RoleRequest $request
     * @return JsonResponse
     */
    public function store(StoreRoleRequest $request)
    {
        $data = Role::create($request->validated('data'));
        return response()->json(['data' => $data], RESPONSE::HTTP_CREATED);
    }
  
    /**
     * @OA\Get(
     *   path="/roles/{role_id}",
     *   summary="Show a Role from his Id",
     *   description="Show a Role from his Id",
     *   operationId="showRole",
     *   tags={"Roles"},
     *   @OA\Parameter(ref="#/components/parameters/Role--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Role"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Role not found"),
     * )
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function show(Role $role)
    {
        return response()->json(['data' => $role]);
    }
   
    // /**
    //  * @OA\Patch(
    //  *   operationId="updateProduct",
    //  *   summary="Update an existing Product",
    //  *   description="Update an existing Product",
    //  *   tags={"Products"},
    //  *   path="/products/{product_id}",
    //  *   @OA\Parameter(ref="#/components/parameters/Product--id"),
    //  *   @OA\Response(response="204",description="No content"),
    //  *   @OA\RequestBody(
    //  *     description="Product to update",
    //  *     required=true,
    //  *     @OA\MediaType(
    //  *       mediaType="application/json",
    //  *       @OA\Schema(
    //  *        @OA\Property(
    //  *        title="data",
    //  *        property="data",
    //  *        type="object",
    //  *        ref="#/components/schemas/Product")
    //  *      )
    //  *     )
    //  *   )
    //  * )
    //  *
    //  * @param Request $request
    //  * @param Product $Product
    //  * @return Response|JsonResponse
    //  */
    // public function update(UpdateProductRequest $request, Product $product)
    // {
    //     $product->update($request->validated('data'));
    //     return response()->json(['data' => $product->refresh()]);
    // }

    // /**
    //  * @OA\Delete(
    //  *  path="/products/{product_id}",
    //  *  summary="Delete a Product",
    //  *  description="Delete a Product",
    //  *  operationId="destroyProduct",
    //  *  tags={"Products"},
    //  *  @OA\Parameter(ref="#/components/parameters/Product--id"),
    //  *  @OA\Response(response=204,description="No content"),
    //  *  @OA\Response(response=404,description="Product not found"),
    //  * )
    //  *
    //  * @param Product $Product
    //  * @return Response|JsonResponse
    //  */
    // public function destroy(Product $product)
    // {
    //     $product->delete();
    //     return response()->noContent();
    // }
}
