<?php

namespace App\Models;

use App\Traits\ConvertContentImageBase64ToUrl;
use App\Traits\GenerateSlug;
use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use App\Traits\HasMasjidId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profil extends Model
{
    use HasFactory;
    use HasCreatedBy, HasMasjid, GenerateSlug;
    use ConvertContentImageBase64ToUrl;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $contentName = 'konten';
}
