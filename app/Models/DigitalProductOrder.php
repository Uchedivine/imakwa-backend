<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DigitalProductOrder extends Model {
    protected $fillable = ['digital_product_tier_id','email','download_token','token_used','token_expires_at','payment_status','payment_reference','payment_gateway','amount_paid'];

    protected $casts = ['token_expires_at' => 'datetime', 'token_used' => 'boolean'];

    public function tier() { return $this->belongsTo(DigitalProductTier::class, 'digital_product_tier_id'); }
}