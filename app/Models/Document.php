<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->slug = (string) Str::slug($model->title);

            if ($file = request()->file('file')) {
                $fileName = microtime().'.'.$file->extension();
                $file->move('storage/document/', $fileName);

                $model->file = $fileName;
            }
        });
    }

    /**
     * Get the user that owns the Document
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(DocumentCategory::class, 'document_category_id');
    }

    /**
     * Interact with the urlBerkas attribute.
     *
     * return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function urlBerkas(): Attribute
    {
        return Attribute::get(fn ($value) => asset('storage/document/'.$this->file));
    }
}
