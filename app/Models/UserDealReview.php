<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDealReview extends Model
{
    use HasFactory;

    protected $table = 'user_deal_reviews';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function userDetails()
    {
        return $this->belongsTo('App\Models\UserDetails', 'user_id', 'user_id');
    }

    public function deal()
    {
        return $this->belongsTo('App\Models\Deals','deal_id');
    }

}
