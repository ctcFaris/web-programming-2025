<?php

/**
 * @OA\Get(
 *     path="/courses",
 *     tags={"Courses"},
 *     summary="Get all courses",
 *     @OA\Response(
 *         response=200,
 *         description="List of all courses"
 *     )
 * )
 */
Flight::route('GET /courses', function() {
    Flight::json(Flight::courseService()->getAllCourses());
});

/**
 * @OA\Get(
 *     path="/courses/{id}",
 *     tags={"Courses"},
 *     summary="Get a course by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Course ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Course details"
 *     )
 * )
 */
Flight::route('GET /courses/@id', function($id) {
    Flight::json(Flight::courseService()->getCourseById($id));
});

/**
 * @OA\Post(
 *     path="/courses",
 *     tags={"Courses"},
 *     summary="Create a new course",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "description"},
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="description", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Created course"
 *     )
 * )
 */
Flight::route('POST /courses', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::courseService()->createCourse($data));
});

/**
 * @OA\Put(
 *     path="/courses/{id}",
 *     tags={"Courses"},
 *     summary="Update an existing course",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Course ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="description", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated course"
 *     )
 * )
 */
Flight::route('PUT /courses/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::courseService()->updateCourse($id, $data));
});

/**
 * @OA\Delete(
 *     path="/courses/{id}",
 *     tags={"Courses"},
 *     summary="Delete a course",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Course ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Course deleted"
 *     )
 * )
 */
Flight::route('DELETE /courses/@id', function($id) {
    Flight::json(Flight::courseService()->deleteCourse($id));
});
