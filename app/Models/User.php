<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Casts\EmailCast;
use App\Casts\NameCast;
use App\Casts\Users\UserTypeCast;
use App\Enums\Users\UserTypeEnum;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Authorizable, FilamentUser
{
	use HasApiTokens, HasFactory, Notifiable, HasUuids, HasRoles, Billable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'user_type',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'name' => NameCast::class,
		'email' => EmailCast::class,
		'email_verified_at' => 'datetime',
		'password' => 'hashed',
		'user_type' => UserTypeEnum::class,
	];

	public function canAccessPanel(Panel $panel): bool
    {
		// dd(auth()->check(), auth()->user(), $this->id);
        return auth()->check() && auth()->user()->user_type === UserTypeEnum::ADMIN;
    }

	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Hash::make($value);
	}

	public function architect(): HasOne
	{
		return $this->hasOne(Architect::class);
	}

	public function journalist(): HasOne
	{
		return $this->hasOne(Journalist::class);
	}

	public function notifications(): HasMany
	{
		return $this->hasMany(Notification::class);
	}

	public function invitations(): HasMany
	{
		return $this->hasMany(InviteColleague::class, 'invited_by');
	}

	public function downloadRequests(): HasMany
	{
		return $this->hasMany(DownloadRequest::class, 'requested_by');
	}

	public function subscriptions(): HasMany
	{
		return $this->hasMany(Subscription::class);
	}

	public function latestSubscription(): HasOne
	{
		return $this->hasOne(Subscription::class)->latestOfMany();
	}

	public function affRegistration(): HasOne
	{
		return $this->hasOne(AffRegistration::class);
	}
}
