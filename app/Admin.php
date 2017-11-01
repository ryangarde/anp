<?php

namespace App;

use App\Notifications\AdminResetPasswordNotification;
use App\Traits\Filtering;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable, SoftDeletes, Filtering;

    /**
     * Admin table
     *
     * @var string
     */
    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The admin has many audit trials.
     *
     * @return array object
     */
    public function auditTrials()
    {
        return $this->hasMany(AuditTrail::class);
    }

    /**
     * The admin has many roles.
     *
     * @return array object
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }
}
