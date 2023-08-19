<?php

namespace App\Models;

use App\Traits\ConvertContentImageBase64ToUrl;
use App\Traits\GenerateSlug;
use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Informasi extends Model
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

    /**
     * Get the kategori that owns the Informasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Rkategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori', 'id');
    }
}
