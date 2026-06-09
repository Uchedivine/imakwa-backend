<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model {
    protected $fillable = ['subject', 'body', 'list', 'status', 'sent_at', 'recipient_count'];
    protected $casts = ['sent_at' => 'datetime'];
}