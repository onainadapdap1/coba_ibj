<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\UserCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserCourseController extends Controller
{
    public function createUserCourse(Request $request) {
        $data = $request->only('course_id');
        $validator = Validator::make($data, [
            'course_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $userCourse = UserCourse::create([
            'users_id' => Auth::guard('user-api')->user()->id,
            'course_id' => $request->input('course_id')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User Course created successfully',
            'data' => $userCourse
        ], Response::HTTP_OK);
    }
    public function updateUserCourse(Request $request, UserCourse $id) {
        $data = $request->only('course_id');
        $validator = Validator::make($data, [
            'course_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $id->update([
            'course_id' => $request->input('course_id')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User course updated successfully',
            'data' => $id
        ], Response::HTTP_OK);
    }

    public function destroyUserCourse($id) {
        $userCourse = UserCourse::find($id);
        $userCourse->delete();

        return response()->json([
            'success' => true,
            'message' => 'User course deleted successfully'
        ], Response::HTTP_OK);
    }

    public function showUserCourse() {
        $currentUser = Auth::guard('user-api')->user()->id;
        $currentData = UserCourse::where('users_id', $currentUser)->get();
        return response()->json([
            'success' => true,
            'message' => 'success show all user courses',
            'data' => $currentData
        ], Response::HTTP_OK);
    }
}
