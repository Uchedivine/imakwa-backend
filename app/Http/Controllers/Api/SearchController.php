<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Artist;
use App\Models\DigitalProduct;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate(['q' => ['required', 'string', 'min:2']]);

        $q = $request->q;

        $artworks = Artwork::with(['artist', 'primaryImage'])
            ->where('is_active', true)
            ->where('is_approved', true)
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%")
                      ->orWhere('medium', 'like', "%{$q}%")
                      ->orWhere('category', 'like', "%{$q}%")
                      ->orWhere('region', 'like', "%{$q}%");
            })
            ->limit(10)
            ->get();

        $artists = Artist::with('user')
            ->where('is_active', true)
            ->where(function ($query) use ($q) {
                $query->where('display_name', 'like', "%{$q}%")
                      ->orWhere('bio', 'like', "%{$q}%")
                      ->orWhere('country', 'like', "%{$q}%");
            })
            ->limit(5)
            ->get();

        $digitalProducts = DigitalProduct::where('is_active', true)
            ->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('country', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%");
            })
            ->limit(5)
            ->get();

        return response()->json([
            'query'           => $q,
            'artworks'        => $artworks,
            'artists'         => $artists,
            'digital_products'=> $digitalProducts,
        ]);
    }

    public function filters()
    {
        return response()->json([
            'categories' => Artwork::where('is_active', true)
                ->where('is_approved', true)
                ->whereNotNull('category')
                ->distinct()
                ->pluck('category'),
            'regions'    => Artwork::where('is_active', true)
                ->where('is_approved', true)
                ->whereNotNull('region')
                ->distinct()
                ->pluck('region'),
            'mediums'    => Artwork::where('is_active', true)
                ->where('is_approved', true)
                ->whereNotNull('medium')
                ->distinct()
                ->pluck('medium'),
        ]);
    }
}