<?php

namespace App\Models;

use App\Traits\ConvertContentImageBase64ToUrl;
use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurban extends Model
{
    use HasFactory;
    use HasCreatedBy, HasMasjid;
    use ConvertContentImageBase64ToUrl;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $casts = [
        'tanggal_akhir_pendaftaran' => 'datetime:d-m-Y H:i',
    ];
    protected $contentName = 'konten';
}
