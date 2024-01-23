<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PublicationLanguage extends Model
{
    use HasFactory;

	public function publications(): BelongsToMany
	{
		return $this->belongsToMany(
			Publication::class,
			'publication_languages',
			'language_id',
			'publication_id',
		);
	}
}
