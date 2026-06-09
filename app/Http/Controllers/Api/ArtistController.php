<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artist;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::with('user')
            ->where('is_active', true)
            ->paginate(20);

        return response()->json($artists);
    }

    public function show($id)
    {
        $artist = Artist::with(['user', 'artworks.primaryImage', 'collections'])
            ->where('is_active', true)
            ->findOrFail($id);

        return response()->json($artist);
    }
}