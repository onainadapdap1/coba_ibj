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
            'message' => 'Course category created successfully',
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

    public function destroycategory($id) {
        $courseCategory = CourseCategory::find($id);
        $courseCategory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Course category deleted successfully'
        ], Response::HTTP_OK);
    }
    public function restorecategory($id) {
        CourseCategory::withTrashed()->findOrFail($id)->restore();

        return response()->json([
            'success' => true,
            'message' => 'Course category restory successfully'
        ], Response::HTTP_OK);
    }
    public function getAllCategories() {
        $courseCategory = CourseCategory::all();

        return response()->json([
            'success' => true,
            'message' => 'success get all course category',
            'data' => $courseCategory
        ], Response::HTTP_OK);
    }
    public function getOneCategory($id) {
        $categoryId = CourseCategory::find($id);
        if (!$categoryId) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Course category not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'success get one course category',
            'data' => $categoryId
        ], Response::HTTP_OK);
    }
}
