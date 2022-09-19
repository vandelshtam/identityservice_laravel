<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @OA\Schema(
 *   description="Role model",
 *   title="Roles",
 *   required={},
 *   @OA\Property(type="integer",description="id of Role",title="id",property="id",example="1",readOnly="true"),
 *   @OA\Property(type="string",description="name of Role",title="name_role",property="name_role",example="Role user"),
 *   @OA\Property(type="integer",description="Code of role",title="code_role",property="code_role",example="0"),
 *   @OA\Property(type="dateTime",title="created_at",property="created_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 *   @OA\Property(type="dateTime",title="updated_at",property="updated_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 * )
 * 
 * @OA\Schema(
 *   schema="Roles",
 *   title="Roles",
 *   @OA\Property(title="data",property="data",type="array",
 *     @OA\Items(type="object",ref="#/components/schemas/Role"),
 *   )
 * )
 * 
 * @OA\Parameter(
 *      parameter="Role--id",
 *      in="path",
 *      name="Role_id",
 *      required=true,
 *      description="Id of Role",
 *      @OA\Schema(
 *          type="integer",
 *          example="1",
 *      )
 * ),
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_role',
        'code_role',
        'created_at',
        'updated_at',
    ];

    protected $casts = [];
}

