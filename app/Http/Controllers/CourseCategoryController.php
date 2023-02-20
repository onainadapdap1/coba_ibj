<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CourseCategoryController extends Controller
{
    public function createCategory(Request $request) {
        $data = $request->only('name');
        $validator = Validator::make($data, [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $courseCategory = CourseCategory::create([
            'name' => $request->name
        ]);

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $courseCategory
        ], Response::HTTP_OK);
    }

    public function updateCategory(Request $request, CourseCategory $id) {
        //Validate data
        $data = $request->only('name');
        $validator = Validator::make($data, [
            'name' => 'required|string'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $id->update([
            'name' => $request->name,
        ]);

        //Product updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'Course Category updated successfully',
            'data' => $id
        ], Response::HTTP_OK);
    }
}
