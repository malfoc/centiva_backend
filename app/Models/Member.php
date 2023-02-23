<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function team()
    {
        return $this->belongsTo(team::class);
    }
}
