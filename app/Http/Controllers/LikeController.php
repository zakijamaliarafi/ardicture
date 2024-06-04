<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function toggle(Request $request)
    {
        $validated_data = $request->validate([
            'post_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($request->like_id==0) {
            $like = Like::create([
                'post_id' => $validated_data['post_id'],
                'user_id' => $validated_data['user_id'],
            ]);
            return response()->json(['success' => true, 'like_id' => $like->id]);
        } else {
            Like::where('id', $request->like_id)->delete();
            return response()->json(['success' => true, 'like_id' => 0]);
        }
    }
}
