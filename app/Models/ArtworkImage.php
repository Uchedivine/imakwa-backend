<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtworkImage extends Model {
    protected $fillable = ['artwork_id','url','is_primary','sort_order'];

    public function artwork() { return $this->belongsTo(Artwork::class); }
}