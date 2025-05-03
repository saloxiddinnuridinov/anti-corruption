<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Appeal;
use App\Models\AppealType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppealController extends Controller
{
    public function types()
    {
        $types = AppealType::all();
        return response()->json($types);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_id' => 'required|exists:appeal_types,id',
            'message' => 'required|string',
            'evidence' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi',
            'selfie' => 'required|image',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = $request->user();

        if ($user->is_blocked) {
            return response()->json(['message' => 'Your account is blocked'], 403);
        }

        $appeal = Appeal::create([
            'user_id' => $user->id,
            'type_id' => $request->type_id,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        if ($request->hasFile('evidence')) {
            $appeal->addMediaFromRequest('evidence')->toMediaCollection('evidence');
        }

        if ($request->hasFile('selfie')) {
            $appeal->addMediaFromRequest('selfie')->toMediaCollection('selfie');
        }

        return response()->json($appeal, 201);
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $appeals = $user->appeals()->with('type')->latest()->get();

        return response()->json($appeals);
    }

    public function show(Request $request, $id)
    {
        $appeal = Appeal::with('type')->findOrFail($id);

        if ($appeal->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($appeal);
    }
}
