<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public const STATUS_PENDING   = 'PENDING';
    public const STATUS_PAID      = 'PAID';
    public const STATUS_CANCELLED = 'CANCELLED';

    protected $fillable = ['user_id', 'amount', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
