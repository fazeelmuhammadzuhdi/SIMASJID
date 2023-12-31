<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kas extends Model
{
    use HasFactory;
    use HasCreatedBy, HasMasjid;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kas';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tanggal' => 'datetime:d-m-Y H:i',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =
    [
        'masjid_id',
        'tanggal',
        'kategori',
        'keterangan',
        'jenis',
        'jumlah',
        'saldo_akhir',
        'created_by'
    ];

    /**
     * Get the masjid that owns the Kas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function masjid(): BelongsTo
    // {
    //     return $this->belongsTo(Masjid::class);
    // }

    /**
     * Get the createdBy that owns the Kas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function createdBy(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'created_by');
    // }

    // public function scopeUserMasjid($q)
    // {
    //     return $q->where('masjid_id', auth()->user()->masjid_id);
    // }
    
    public function scopeSaldoAkhir($query, $masjidId = null)
    {
        // $masjidId = $masjidId ?? auth()->user()->masjid_id;
        // return $query->where('masjid_id', $masjidId)
        //     ->orderBy('created_at', 'desc')
        //     ->value('saldo_akhir') ?? 0;

        $masjidId = $masjidId ?? auth()->user()->masjid_id;
        $masjid = Masjid::where('id', $masjidId)->first();
        return $masjid->saldo_akhir ?? 0;
    }

    
}
