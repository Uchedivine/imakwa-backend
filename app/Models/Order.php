<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model {
    protected $fillable = [
        'user_id','reference','fulfillment_type','status','payment_gateway',
        'payment_reference','payment_status','subtotal','shipping_cost','total',
        'currency','shipping_name','shipping_email','shipping_phone',
        'shipping_address','shipping_city','shipping_country','shipping_postal_code',
    ];

    protected static function boot() {
        parent::boot();
        static::creating(function ($order) {
            $order->reference = 'IMK-' . strtoupper(Str::random(8));
        });
    }

    public function user() { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(OrderItem::class); }
}