<?php

/**
 * @OA\Get(
 *     path="/contact",
 *     tags={"Contact"},
 *     summary="Get all messages",
 *     @OA\Response(
 *         response=200,
 *         description="List of all contact messages"
 *     )
 * )
 */
Flight::route('GET /contact', function() {
    Flight::json(Flight::contactMeService()->getAllMessages());
});

/**
 * @OA\Get(
 *     path="/contact/{id}",
 *     tags={"Contact"},
 *     summary="Get a specific contact message by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Contact message ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Contact message details"
 *     )
 * )
 */
Flight::route('GET /contact/@id', function($id) {
    Flight::json(Flight::contactMeService()->getMessageById($id));
});

/**
 * @OA\Get(
 *     path="/contact/user/{user_id}",
 *     tags={"Contact"},
 *     summary="Get all messages for a specific user",
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Messages for the user"
 *     )
 * )
 */
Flight::route('GET /contact/user/@user_id', function($user_id) {
    Flight::json(Flight::contactMeService()->getMessagesByUserId($user_id));
});

/**
 * @OA\Post(
 *     path="/contact",
 *     tags={"Contact"},
 *     summary="Create a new contact message",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "message"},
 *             @OA\Property(property="user_id", type="integer"),
 *             @OA\Property(property="message", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Created contact message"
 *     )
 * )
 */
Flight::route('POST /contact', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::contactMeService()->createMessage($data));
});

/**
 * @OA\Put(
 *     path="/contact/{id}",
 *     tags={"Contact"},
 *     summary="Update an existing contact message",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Contact message ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated contact message"
 *     )
 * )
 */
Flight::route('PUT /contact/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::contactMeService()->updateMessage($id, $data));
});

/**
 * @OA\Delete(
 *     path="/contact/{id}",
 *     tags={"Contact"},
 *     summary="Delete a contact message",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Contact message ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Contact message deleted"
 *     )
 * )
 */
Flight::route('DELETE /contact/@id', function($id) {
    Flight::json(Flight::contactMeService()->deleteMessage($id));
});

/**
 * @OA\Get(
 *     path="/contact/ids",
 *     tags={"Contact"},
 *     summary="Get only the IDs of all contact messages",
 *     @OA\Response(
 *         response=200,
 *         description="List of contact message IDs"
 *     )
 * )
 */
Flight::route('GET /contact/ids', function() {
    $messages = Flight::contactMeService()->getAllMessages();
    $ids = array_map(fn($msg) => $msg['contact_id'], $messages);
    Flight::json($ids);
});
