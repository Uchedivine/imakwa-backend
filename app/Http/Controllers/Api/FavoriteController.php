<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Artwork;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $favorites = Favorite::with('favoriteable')
            ->where('user_id', $request->user()->id)
            ->get();
        return response()->json($favorites);
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'item_type' => ['required', 'in:artwork'],
            'item_id'   => ['required', 'integer'],
        ]);

        $type = Artwork::class;
        $existing = Favorite::where('user_id', $request->user()->id)
            ->where('favoriteable_id', $request->item_id)
            ->where('favoriteable_type', $type)
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['message' => 'Removed from favorites', 'favorited' => false]);
        }

        Favorite::create([
            'user_id'            => $request->user()->id,
            'favoriteable_id'    => $request->item_id,
            'favoriteable_type'  => $type,
        ]);

        return response()->json(['message' => 'Added to favorites', 'favorited' => true], 201);
    }
}