<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealViewed extends Model
{
    use HasFactory;
    protected $table = 'deal_viewed';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function deals()
    {
        return $this->belongsTo('App\Models\Deals', 'deal_id');
    }
}
