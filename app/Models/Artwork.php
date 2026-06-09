<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artwork extends Model {
    protected $fillable = ['artist_id','title','description','medium','dimensions','year','price','currency','status','site_context','category','region','is_active','is_approved'];

    public function artist() { return $this->belongsTo(Artist::class); }
    public function images() { return $this->hasMany(ArtworkImage::class); }
    public function collections() { return $this->belongsToMany(Collection::class, 'artwork_collections'); }
    public function primaryImage() { return $this->hasOne(ArtworkImage::class)->where('is_primary', true); }
}