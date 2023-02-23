<?php

namespace App\Models;

use App\Mail\NewMemberNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'fullname',
        'email',
        'team_id',
    ];
    
    protected $hidden = [
        'team_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();

        static::created(function ($member) {
            Mail::to($member->email)->send(new NewMemberNotification($member));
        });
    }

    public function team()
    {
        return $this->belongsTo(team::class);
    }
}
