<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login',    [AuthController::class, 'login']);

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::get('/user',    [AuthController::class, 'me']);
        });
    });

    // Gallery
Route::prefix('gallery')->group(function () {
    Route::get('/artworks',           [App\Http\Controllers\Api\ArtworkController::class, 'index']);
    Route::get('/artworks/{id}',      [App\Http\Controllers\Api\ArtworkController::class, 'show']);
    Route::get('/artists',            [App\Http\Controllers\Api\ArtistController::class, 'index']);
    Route::get('/artists/{id}',       [App\Http\Controllers\Api\ArtistController::class, 'show']);
    Route::get('/collections',        [App\Http\Controllers\Api\CollectionController::class, 'index']);
    Route::get('/collections/{id}',   [App\Http\Controllers\Api\CollectionController::class, 'show']);
});

// World Cup
Route::prefix('worldcup')->group(function () {
    Route::get('/products',          [App\Http\Controllers\Api\WorldCupController::class, 'index']);
    Route::get('/products/{id}',     [App\Http\Controllers\Api\WorldCupController::class, 'show']);
    Route::get('/countdown',         [App\Http\Controllers\Api\WorldCupController::class, 'countdown']);
});

// Cart
Route::prefix('cart')->group(function () {
    Route::get('/',           [App\Http\Controllers\Api\CartController::class, 'index']);
    Route::post('/add',       [App\Http\Controllers\Api\CartController::class, 'add']);
    Route::delete('/{itemId}',[App\Http\Controllers\Api\CartController::class, 'remove']);
    Route::delete('/',        [App\Http\Controllers\Api\CartController::class, 'clear']);
    Route::post('/merge',     [App\Http\Controllers\Api\CartController::class, 'merge']);
});

// Favorites (auth required)
Route::middleware('auth:sanctum')->prefix('favorites')->group(function () {
    Route::get('/',       [App\Http\Controllers\Api\FavoriteController::class, 'index']);
    Route::post('/toggle',[App\Http\Controllers\Api\FavoriteController::class, 'toggle']);
});


// Orders (auth required)
Route::middleware('auth:sanctum')->prefix('orders')->group(function () {
    Route::get('/',      [App\Http\Controllers\Api\OrderController::class, 'index']);
    Route::post('/',     [App\Http\Controllers\Api\OrderController::class, 'store']);
    Route::get('/{id}',  [App\Http\Controllers\Api\OrderController::class, 'show']);
});

// World Cup Checkout
Route::prefix('worldcup')->group(function () {
    Route::post('/checkout',           [App\Http\Controllers\Api\WorldCupOrderController::class, 'store']);
    Route::get('/download/{token}',    [App\Http\Controllers\Api\WorldCupOrderController::class, 'download']);
    Route::get('/order-status/{id}',   [App\Http\Controllers\Api\WorldCupOrderController::class, 'status']);
});

// Webhooks
Route::prefix('webhooks')->group(function () {
    Route::post('/stripe',   [App\Http\Controllers\Api\WebhookController::class, 'stripe']);
    Route::post('/paystack', [App\Http\Controllers\Api\WebhookController::class, 'paystack']);
});


// Search
Route::get('/search',          [App\Http\Controllers\Api\SearchController::class, 'search']);
Route::get('/search/filters',  [App\Http\Controllers\Api\SearchController::class, 'filters']);

// Newsletter
Route::post('/newsletter/subscribe',   [App\Http\Controllers\Api\NewsletterController::class, 'subscribe']);
Route::post('/newsletter/unsubscribe', [App\Http\Controllers\Api\NewsletterController::class, 'unsubscribe']);


});