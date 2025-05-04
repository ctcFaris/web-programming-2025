<?php

/**
 * @OA\Get(
 *     path="/locations",
 *     tags={"Locations"},
 *     summary="Get all locations",
 *     @OA\Response(
 *         response=200,
 *         description="List of all locations"
 *     )
 * )
 */
Flight::route('GET /locations', function() {
    Flight::json(Flight::locationService()->getAllLocations());
});

/**
 * @OA\Get(
 *     path="/locations/{id}",
 *     tags={"Locations"},
 *     summary="Get location by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Location ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Location details"
 *     )
 * )
 */
Flight::route('GET /locations/@id', function($id) {
    Flight::json(Flight::locationService()->getLocationById($id));
});

/**
 * @OA\Post(
 *     path="/locations",
 *     tags={"Locations"},
 *     summary="Create a new location",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             example={"name": "Main Campus", "address": "123 Street"}
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Location created"
 *     )
 * )
 */
Flight::route('POST /locations', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::locationService()->createLocation($data));
});

/**
 * @OA\Put(
 *     path="/locations/{id}",
 *     tags={"Locations"},
 *     summary="Update an existing location",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Location ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             example={"name": "Updated Campus", "address": "New Address"}
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Location updated"
 *     )
 * )
 */
Flight::route('PUT /locations/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::locationService()->updateLocation($id, $data));
});

/**
 * @OA\Delete(
 *     path="/locations/{id}",
 *     tags={"Locations"},
 *     summary="Delete a location by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Location ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Location deleted"
 *     )
 * )
 */
Flight::route('DELETE /locations/@id', function($id) {
    Flight::json(Flight::locationService()->deleteLocation($id));
});
