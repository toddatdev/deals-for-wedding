<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDeal extends Model
{
    use HasFactory;

     protected $table = 'user_deals';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function deal()
    {
        return $this->belongsTo('App\Models\Deals','deal_id');
    }
}
