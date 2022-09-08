<?php

namespace App\Models;

use App\Support\Trait\HasPagination;
use App\Support\Trait\HasSearch;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasPagination;
    use HasProfilePhoto;
    use HasSearch;
    use Notifiable;
    use SoftDeletes;
    use TwoFactorAuthenticatable;

    const USER_ADMIN = 1;
    const USER_OTHER = 0;
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function roles()
    {
        return $this->morphToMany(Role::class, 'roleable');
    }

    public function hasPermission($permissionName)
    {
        $permissions = $this->roles()
            ->with(['permissions'])
            ->get()
            ->map(function($role){
                return $role->permissions->pluck('name')->all();
            })
            ->collapse()
            ->toArray();

        return in_array($permissionName, $permissions);
    }
}
