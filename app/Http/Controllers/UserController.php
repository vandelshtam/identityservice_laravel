<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Response\GeneralResponse;
use App\Http\Requests\UpdateUserRequest;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

      /**
     * Create a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');        
    }

     /**
     * @OA\Get(
     *  operationId="index",
     *  summary="User index",
     *  description="User index",
     *  security={{ "bearerAuth": {} }},
     *  tags={"Users"},
     *      path="/users",
     *      summary="Get list User",
     *      description="Returns User data",
    
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function index()
    {
        return (new GeneralResponse)->default_json(
            $success=true,
            $message = "Success",
            $data= response()->json(User::all())->original,
            $code= Response::HTTP_ACCEPTED
        );
    }

  
     /**
     * @OA\Post(
     *  operationId="store",
     *  summary="User store",
     *  description="User store",
     *  security={{ "bearerAuth": {} }},
     *  tags={"Users"},
     *      path="/users/store",
      *      summary="Create User",
     *      description="Returns User data",
     *     @OA\Parameter(
     *          name="email",
     *          description="Email Field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *      @OA\Parameter(
     *          name="username",
     *          description="Username Field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *      @OA\Parameter(
     *          name="firstname",
     *          description="First Name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *      @OA\Parameter(
     *          name="lastname",
     *          description="Last Name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="password",
     *          description="Password",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *  @OA\Parameter(
     *          name="password2",
     *          description="Password",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),

     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *  *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function store(Request $request)
    {
        $request_input = $request->all();
        if(User::where("email", $request_input['email'])->count()){
            return (new GeneralResponse)->default_json(
                $success=false,
                $message= "Email is exist",
                $data=[],
                $code=Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
        $user = User::create($request_input);
        return (new GeneralResponse)->default_json(
            $success=true,
            $message= "Succes",
            //$data= new UserResource($user),
            $data= $user,
            $code= Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Get(
     *  operationId="show",
     *  summary="User show",
     *  description="User show",
     *  security={{ "bearerAuth": {} }},
     *  tags={"Users"},
     *      path="/users/{id}",
      *      summary="Get detail User",
     *      description="Returns User data",
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *  *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if(!User::find($id)){
        //     return response()->json([
        //         $success=false,
        //         $message= "User not found",
        //         $data=[],
        //         $code=404
        //     ]   );
        // }
        //$user = User::find($id);
        //return response()->json(['data' => $id]);
        return (new GeneralResponse)->default_json(
            $success=true,
            $message= "Succes",
            $data= response()->json(User::find($id))->original,
            //$code= Response::HTTP_ACCEPTED
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     
    }

     /**
     * @OA\Put(
     *  operationId="update",
     *  summary="User update",
     *  description="User update",
     *  security={{ "bearerAuth": {} }},
     *  tags={"Users"},
     *      path="/users/{id}",
     *      summary="Update existing User",
     *      description="Returns updated User data",
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\RequestBody(
     *      description="Book to create",
     *      required=true,
     *        @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *            @OA\Property(
     *            title="data",
     *            property="data",
     *            type="object",
     *            ref="#/components/schemas/User")
     *     )
     *    )
     *  ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        $user->update($request->validated('data'));
        //return response()->json(['data' => $user->refresh()]);
        
        //$user->update($request->all());

        return (new GeneralResponse)->default_json(
            $success=true,
            $message= "Success",
            $data= response()->json($user)->original,
            $code= Response::HTTP_ACCEPTED
        );
    }

  
    /**
     * @OA\Delete(
     *  operationId="delete",
     *  summary="User delete",
     *  description="User delete",
     *  security={{ "bearerAuth": {} }},
     *  tags={"Users"},
     *      path="/users/{id}",
     *      summary="Delete existing User",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent({})
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(User $user, $id)
    {
        //$user->delete();
        //return response()->noContent();
        //$user = User::all()->where('id', 2);
        if(!User::find($id)){
            return (new GeneralResponse)->default_json(
                $success=false,
                $message= "user not found",
                $data=[],
                $code=Response::HTTP_NO_CONTENT
            );
        }
        $user = User::find($id);
        $user->delete();
        //return response()->json(['data' => $user]);
        return (new GeneralResponse)->default_json(
            $success=true,
            $message= "Success",
            $data=[],
            $code= Response::HTTP_NO_CONTENT
        );
    }
}