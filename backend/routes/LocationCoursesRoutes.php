<?php

/**
 * @OA\Get(
 *     path="/locations/{location_id}/courses",
 *     tags={"LocationCourses"},
 *     summary="Get all courses for a specific location",
 *     @OA\Parameter(
 *         name="location_id",
 *         in="path",
 *         required=true,
 *         description="Location ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of courses at the location"
 *     )
 * )
 */
Flight::route('GET /locations/@location_id/courses', function($location_id) {
    Flight::json(Flight::locationCoursesService()->getCoursesByLocation($location_id));
});

/**
 * @OA\Get(
 *     path="/courses/{course_id}/locations",
 *     tags={"LocationCourses"},
 *     summary="Get all locations for a specific course",
 *     @OA\Parameter(
 *         name="course_id",
 *         in="path",
 *         required=true,
 *         description="Course ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of locations for the course"
 *     )
 * )
 */
Flight::route('GET /courses/@course_id/locations', function($course_id) {
    Flight::json(Flight::locationCoursesService()->getLocationsByCourse($course_id));
});

/**
 * @OA\Post(
 *     path="/locations/{location_id}/courses/{course_id}",
 *     tags={"LocationCourses"},
 *     summary="Add a course to a location",
 *     @OA\Parameter(
 *         name="location_id",
 *         in="path",
 *         required=true,
 *         description="Location ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="course_id",
 *         in="path",
 *         required=true,
 *         description="Course ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Course added to location"
 *     )
 * )
 */
Flight::route('POST /locations/@location_id/courses/@course_id', function($location_id, $course_id) {
    Flight::json(Flight::locationCoursesService()->addCourseToLocation($location_id, $course_id));
});

/**
 * @OA\Delete(
 *     path="/locations/{location_id}/courses/{course_id}",
 *     tags={"LocationCourses"},
 *     summary="Remove a course from a location",
 *     @OA\Parameter(
 *         name="location_id",
 *         in="path",
 *         required=true,
 *         description="Location ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="course_id",
 *         in="path",
 *         required=true,
 *         description="Course ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Course removed from location"
 *     )
 * )
 */
Flight::route('DELETE /locations/@location_id/courses/@course_id', function($location_id, $course_id) {
    Flight::json(Flight::locationCoursesService()->removeCourseFromLocation($location_id, $course_id));
});
