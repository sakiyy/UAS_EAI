<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Enrollment;


class CourseController extends Controller
{
    //
    public function index()
    {
        // return Course::all();
        return response()->json([
            'courses' => Course::all()
        ]);
    }

    public function show($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return $course;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
        ]);

        $course = Course::create($request->all());
        return response()->json([
            'message' => 'Course created successfully!',
            'course' => $course
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $course->update($request->only(['title', 'description', 'price']));

        return response()->json([
            'message' => 'Course updated successfully',
            'course' => $course
        ]);
    }

    public function destroy($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $course->delete();

        return response()->json(['message' => 'Course deleted successfully']);
    }
    public function enroll($id)
    {
        $user_id = JWTAuth::parseToken()->getPayload()->get('sub');

        $course = Course::findOrFail($id);

        // Simpan ke tabel relasi
        Enrollment::create([
            'user_id' => $user_id,
            'course_id' => $course->id,
        ]);

        return response()->json([
            'message' => 'Berhasil daftar course!',
            'course' => $course
        ]);
    }

    public function myCourses()
    {
        // $user_id = JWTAuth::parseToken()->getPayload()->get('sub');

        // $courses = Course::whereHas('enrollments', function ($query) use ($user_id) {
        //     $query->where('user_id', $user_id);
        // })->get();

        // return response()->json($courses);
        $payload = JWTAuth::parseToken()->getPayload();
        $user_id = $payload->get('sub'); // Ambil ID user dari token (tanpa cek DB)

        $courses = Course::whereHas('enrollments', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();

        return response()->json([
            'user' => [
                'id' => $user_id
            ],
            'courses' => $courses
        ]);
    }
}
