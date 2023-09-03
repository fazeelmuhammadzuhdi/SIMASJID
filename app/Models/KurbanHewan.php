<?php

namespace App\Models;

use App\Traits\HasMasjid;
use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KurbanHewan extends Model
{
    use HasFactory;
    use HasCreatedBy, HasMasjid;

    protected $guarded = [];

    protected $appends = ['nama_full'];

    public function getNamaFullAttribute()
    {
        return ucwords($this->hewan) . " - {$this->kriteria} - " . formatRupiah($this->iuran_perorang, true);
    }

    /**
     * Get the kurban that owns the KurbanHewan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kurban(): BelongsTo
    {
        return $this->belongsTo(Kurban::class);
    }

    /**
     * Get all of the kurbanPeserta for the KurbanHewan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // jadi 1 hewan kurban memiliki banyak peserta
    public function kurbanPeserta(): HasMany
    {
        return $this->hasMany(KurbanPeserta::class);
    }
}
