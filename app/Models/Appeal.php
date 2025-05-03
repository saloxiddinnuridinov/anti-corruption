<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appeal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_id',
        'message',
        'status',
        'admin_comment',
        'is_fake'
    ];

    protected $casts = [
        'is_fake' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(AppealType::class, 'type_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('evidence')
            ->useDisk('public')
            ->singleFile();

        $this->addMediaCollection('selfie')
            ->useDisk('public')
            ->singleFile();
    }
}
