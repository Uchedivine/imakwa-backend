<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model {
    protected $fillable = ['artist_id','name','description','cover_image','is_active'];

    public function artist() { return $this->belongsTo(Artist::class); }
    public function artworks() { return $this->belongsToMany(Artwork::class, 'artwork_collections'); }
}