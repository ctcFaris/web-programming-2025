<?php

require_once __DIR__ . '/../data/roles.php'; // ✅ Import Roles class

/**
 * @OA\Get(
 *     path="/payments",
 *     tags={"Payments"},
 *     summary="Get all payments",
 *     @OA\Response(
 *         response=200,
 *         description="List of all payments"
 *     )
 * )
 */
Flight::route('GET /payments', function() {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN); // ✅ Admin only
    Flight::json(Flight::paymentService()->getAllPayments());
});

/**
 * @OA\Get(
 *     path="/payments/{id}",
 *     tags={"Payments"},
 *     summary="Get payment by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Payment ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Payment details"
 *     )
 * )
 */
Flight::route('GET /payments/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]); // ✅ User can see own, Admin sees all
    Flight::json(Flight::paymentService()->getPaymentById($id));
});

/**
 * @OA\Post(
 *     path="/payments",
 *     tags={"Payments"},
 *     summary="Create a new payment",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             example={"user_id": 1, "amount": 200.00, "method": "Credit Card", "timestamp": "2025-05-04 10:00:00"}
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Payment created"
 *     )
 * )
 */
Flight::route('POST /payments', function() {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]); // ✅ Both can create
    $data = Flight::request()->data->getData();
    Flight::json(Flight::paymentService()->createPayment($data));
});

/**
 * @OA\Put(
 *     path="/payments/{id}",
 *     tags={"Payments"},
 *     summary="Update an existing payment",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Payment ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             example={"user_id": 1, "amount": 250.00, "method": "Debit Card", "timestamp": "2025-05-04 12:00:00"}
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Payment updated"
 *     )
 * )
 */
Flight::route('PUT /payments/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN); // ✅ Admin only
    $data = Flight::request()->data->getData();
    Flight::json(Flight::paymentService()->updatePayment($id, $data));
});

/**
 * @OA\Delete(
 *     path="/payments/{id}",
 *     tags={"Payments"},
 *     summary="Delete a payment",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Payment ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Payment deleted"
 *     )
 * )
 */
Flight::route('DELETE /payments/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN); // ✅ Admin only
    Flight::json(Flight::paymentService()->deletePayment($id));
});
