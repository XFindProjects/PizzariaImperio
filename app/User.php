<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 18/11/2017
 * Hora: 2:9:15
 */

namespace Pizzaria;

use Acl\Traits\BelongsToArea;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Model\Support\Traits\HasFactory;
use Model\Support\Traits\HasRouteMethods;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Pizzaria\User
 *
 * @property int $id
 * @property string|null $profile_picture
 * @property string $slug
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $role
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzaria\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzaria\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzaria\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzaria\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzaria\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzaria\User whereProfilePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzaria\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzaria\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzaria\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzaria\User whereSlug($value)
 * @property-read mixed $admin_area_path
 * @property-read mixed $delete_path
 * @property-read mixed $update_path
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzaria\User findSimilarSlugs($attribute, $config, $slug)
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRouteMethods, Sluggable, HasFactory, BelongsToArea;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_picture',
        'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->id;
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    function routeMethods(): array
    {
        return [
            'token'
        ];
    }

    function routeExcludes(): array
    {
        return [];
    }
}
