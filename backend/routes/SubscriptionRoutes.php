<?php

/**
 * @OA\Get(
 *     path="/subscriptions",
 *     tags={"Subscriptions"},
 *     summary="Get all subscriptions",
 *     @OA\Response(
 *         response=200,
 *         description="List of all subscriptions"
 *     )
 * )
 */
Flight::route('GET /subscriptions', function() {
    Flight::json(Flight::subscriptionService()->getAllSubscriptions());
});

/**
 * @OA\Get(
 *     path="/subscriptions/{id}",
 *     tags={"Subscriptions"},
 *     summary="Get subscription by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Subscription ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Subscription details"
 *     )
 * )
 */
Flight::route('GET /subscriptions/@id', function($id) {
    Flight::json(Flight::subscriptionService()->getSubscriptionById($id));
});

/**
 * @OA\Get(
 *     path="/subscriptions/name/{name}",
 *     tags={"Subscriptions"},
 *     summary="Get subscription by name",
 *     @OA\Parameter(
 *         name="name",
 *         in="path",
 *         required=true,
 *         description="Subscription name",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Subscription details by name"
 *     )
 * )
 */
Flight::route('GET /subscriptions/name/@name', function($name) {
    Flight::json(Flight::subscriptionService()->getSubscriptionByName($name));
});

/**
 * @OA\Post(
 *     path="/subscriptions",
 *     tags={"Subscriptions"},
 *     summary="Create a new subscription",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             example={"name": "Premium", "price": 29.99, "duration_days": 30}
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Subscription created"
 *     )
 * )
 */
Flight::route('POST /subscriptions', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::subscriptionService()->createSubscription($data));
});

/**
 * @OA\Put(
 *     path="/subscriptions/{id}",
 *     tags={"Subscriptions"},
 *     summary="Update an existing subscription",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Subscription ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             example={"name": "Pro", "price": 39.99, "duration_days": 60}
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Subscription updated"
 *     )
 * )
 */
Flight::route('PUT /subscriptions/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::subscriptionService()->updateSubscription($id, $data));
});

/**
 * @OA\Delete(
 *     path="/subscriptions/{id}",
 *     tags={"Subscriptions"},
 *     summary="Delete a subscription",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Subscription ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Subscription deleted"
 *     )
 * )
 */
Flight::route('DELETE /subscriptions/@id', function($id) {
    Flight::json(Flight::subscriptionService()->deleteSubscription($id));
});
