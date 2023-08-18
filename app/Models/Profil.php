<?php

namespace App\Models;

use App\Traits\ConvertContentImageBase64ToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profil extends Model
{
    use HasFactory;
    use ConvertContentImageBase64ToUrl;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $contentName = 'konten';


    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeUserMasjid($q)
    {
        return $q->where('masjid_id', auth()->user()->masjid_id);
    }
}
