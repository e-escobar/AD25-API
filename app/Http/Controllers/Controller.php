<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="API Documentation",
 *     version="1.0.0"
 * )
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http", 
 *     scheme="bearer",
 *     bearerFormat="token",
 *     in="header",
 *     name="Authorization"
 * )
 * @OA\Server(url="https://ad25-api-production.up.railway.app")
 */

abstract class Controller
{
    //
}
