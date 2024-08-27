<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{

    public function index()
    {
        $reviews = Review::all();
        return response()->json($reviews);
    }
    public function create(Request $request)
    {
        // create validation rules
        $rules = [
            'product_id' => 'required',
            'user_id' => 'required',
            'review_text' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ];

        // validate the request
        $validator = Validator::make($request->all(), $rules);

        // return validation errors
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $review = Review::create([
            'product_id' => $request->input('product_id'),
            'user_id' => $request->input('user_id'),
            'review_text' => $request->input('review_text'),
            'rating' => $request->input('rating'),
        ]);
        return response()->json($review, 201);
    }

    public function getReviews($productId)
    {
        $reviews = Review::where('product_id', $productId)->get();
        return response()->json($reviews);
    }

    public function update(Request $request, $id)
    {
        $review = Review::find($id);
        if ($review) {
            $review->update($request->only(['review_text', 'rating']));
            return response()->json($review);
        } else {
            return response()->json(['message' => 'Review not found'], 404);
        }
    }

    public function delete($id)
    {
        $review = Review::find($id);
        if ($review) {
            $review->delete();
            return response()->json(['message' => 'Review deleted']);
        } else {
            return response()->json(['message' => 'Review not found'], 404);
        }
    }
}
