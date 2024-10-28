<?php

namespace App\Models;

use App\Enum\ActiveEnum;
use App\Enum\JenisPerizinanEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class InstansiLayanan extends Model implements Searchable
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'instansi_layanan';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public $searchableType = 'Layanan';

    public function getSearchResult(): SearchResult
    {
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->nama,
            $this->instansi->url
        );
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->slug = (string) Str::slug($model->nama);
        });
    }

    public function instansi(): BelongsTo
    {
        return $this->belongsTo(Instansi::class, 'instansi_id');
    }

    public function getStatusAttribute(): string
    {
        if ($this->publish == ActiveEnum::ACTIVE->value) {
            return '<span class="badge bg-green mb-1">Publish</span>';
        }

        return '<span class="badge bg-secondary mb-1">Pending</span>';
    }

    public function getJenisLabelAttribute(): string
    {
        if ($this->jenis == JenisPerizinanEnum::PERIZINAN->value) {
            return '<span class="badge bg-yellow mb-1">'.JenisPerizinanEnum::label($this->jenis).'</span>';
        }

        return '<span class="badge bg-secondary mb-1">'.JenisPerizinanEnum::label($this->jenis).'</span>';
    }

    public function getLinkLabelAttribute(): string
    {
        if ($this->link != '') {
            return '<span class="badge bg-blue mb-1">Online</span>';
        }

        return '';
    }
}
