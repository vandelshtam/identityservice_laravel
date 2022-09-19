<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Product;
use Illuminate\Http\Response;
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
}
