<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    public function createCourse(Request $request) {
        $data = $request->only( 'title', 'course_category_id');
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'course_category_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $course = Course::create([
            'title' => $request->title,
            'course_category_id' => $request->course_category_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Course created successfully',
            'data' => $course
        ], Response::HTTP_OK);
    }

    public function updateCourse(Request $request, Course $id) {
        $data = $request->only( 'title', 'course_category_id');
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'course_category_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $id->update([
            'title' => $request->title,
            'course_category_id' => $request->course_category_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Course updated successfully',
            'data' => $id
        ], Response::HTTP_OK);
    }

    public function destroyCourse($id) {
        $course = Course::find($id);
        $course->delete();

        return response()->json([
            'success' => true,
            'message' => 'Course deleted successfully'
        ], Response::HTTP_OK);
    }

    public function restoreCourse($id) {
        Course::withTrashed()->findOrFail($id)->restore();

        return response()->json([
            'success' => true,
            'message' => 'Course restore successfully'
        ], Response::HTTP_OK);
    }

    public function getAllCourse() {
        $course = Course::all();

        return response()->json([
            'success' => true,
            'message' => 'success get all course category',
            'data' => $course
        ], Response::HTTP_OK);
    }

    public function getOneCourse($id) {
        $courseId = Course::find($id);

        if(!$courseId) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Course not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'success get one course',
            'data' => $courseId
        ], Response::HTTP_OK);
    }
}
