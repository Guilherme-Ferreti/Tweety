<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message'];

    protected $dates = ['seen_at'];

    public function markAsSeen()
    {
        $this->seen_at = now();

        $this->save();
    }

}
