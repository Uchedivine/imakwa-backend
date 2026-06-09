<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collection;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::with('artist')
            ->where('is_active', true)
            ->paginate(20);

        return response()->json($collections);
    }

    public function show($id)
    {
        $collection = Collection::with(['artist', 'artworks.primaryImage'])
            ->where('is_active', true)
            ->findOrFail($id);

        return response()->json($collection);
    }
}