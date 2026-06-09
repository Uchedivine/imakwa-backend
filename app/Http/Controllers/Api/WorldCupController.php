<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DigitalProduct;
use Carbon\Carbon;

class WorldCupController extends Controller
{
    public function index()
    {
        $products = DigitalProduct::with(['tiers' => function ($q) {
            $q->where('is_active', true)->orderBy('tier');
        }])
        ->where('is_active', true)
        ->get()
        ->map(function ($product) {
            $product->is_open = $product->isOpen();
            $product->tiers->map(function ($tier) {
                $tier->available_licenses = $tier->availableLicenses();
                $tier->is_sold_out = $tier->isSoldOut();
                return $tier;
            });
            return $product;
        });

        return response()->json($products);
    }

    public function show($id)
    {
        $product = DigitalProduct::with(['tiers' => function ($q) {
            $q->where('is_active', true)->orderBy('tier');
        }])->findOrFail($id);

        $product->is_open = $product->isOpen();
        $product->tiers->map(function ($tier) {
            $tier->available_licenses = $tier->availableLicenses();
            $tier->is_sold_out = $tier->isSoldOut();
            return $tier;
        });

        return response()->json($product);
    }

    public function countdown()
    {
        $worldCupStart = Carbon::parse('2026-06-11');
        $worldCupFinal = Carbon::parse('2026-07-19');
        $now = Carbon::now();

        return response()->json([
            'world_cup_started'    => $now->gte($worldCupStart),
            'world_cup_ended'      => $now->gt($worldCupFinal),
            'days_to_final'        => max(0, (int) $now->diffInDays($worldCupFinal, false)),
            'hours_to_final'       => max(0, (int) $now->diffInHours($worldCupFinal, false)),
            'final_date'           => $worldCupFinal->toDateString(),
            'store_closes'         => $worldCupFinal->toDateString(),
        ]);
    }
}