<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppealType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function appeals()
    {
        return $this->hasMany(Appeal::class, 'type_id');
    }
}
