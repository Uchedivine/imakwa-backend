<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'name'  => ['nullable', 'string', 'max:255'],
            'list'  => ['nullable', 'in:inner_circle,general'],
        ]);

        $subscriber = NewsletterSubscriber::updateOrCreate(
            ['email' => $request->email],
            [
                'name'      => $request->name,
                'list'      => $request->list ?? 'general',
                'is_active' => true,
            ]
        );

        return response()->json([
            'message' => 'Subscribed successfully',
            'list'    => $subscriber->list,
        ], 201);
    }

    public function unsubscribe(Request $request)
    {
        $request->validate(['email' => ['required', 'email']]);

        NewsletterSubscriber::where('email', $request->email)
            ->update(['is_active' => false]);

        return response()->json(['message' => 'Unsubscribed successfully']);
    }
}