<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DigitalProduct extends Model {
    protected $fillable = ['name','description','cover_image','country','flag_emoji','is_active','closes_at'];

    protected $casts = ['closes_at' => 'datetime'];

    public function tiers() { return $this->hasMany(DigitalProductTier::class); }

    public function isOpen(): bool {
        return $this->is_active && ($this->closes_at === null || $this->closes_at->isFuture());
    }
}