<?php

namespace App\Models;

use App\Traits\ConvertContentImageBase64ToUrl;
use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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


    /**
     * Get all of the kurbanHewan for the Kurban
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kurbanHewan(): HasMany
    {
        return $this->hasMany(KurbanHewan::class);
    }

    /**
     * Get all of the kurbanPeserta for the Kurban
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kurbanPeserta(): HasMany
    {
        return $this->hasMany(KurbanPeserta::class);
    }
}
