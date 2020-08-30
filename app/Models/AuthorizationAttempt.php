<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorizationAttempt extends Model
{
    protected $fillable = [ 'application_id', 'user_id', 'authorization_attempt_id', 'status', 'expires_at'];

    const TTL = 5; // Time to live in minutes

    const STATUSES = [
      self::STATUS_PENDING,
      self::STATUS_GRANTED,
      self::STATUS_DENIED,
      self::STATUS_TIMED_OUT,
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_GRANTED = 'granted';
    const STATUS_DENIED = 'denied';
    const STATUS_TIMED_OUT = 'timed_out';

    public function application() {
      return $this->belongsTo(Application::class);
    }

    public function user() {
      return $this->belongsTo(User::class);
    }
}
