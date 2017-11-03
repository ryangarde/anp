<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    /**
     * Admin role table.
     *
     * @var string
     */
    protected $table = 'admin_role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id', 'role_id'
    ];

    /**
     * Admin role belongs to a admin.
     *
     * @return object array
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Admin role belongs to a role.
     *
     * @return object array
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * User role has many permissions.
     *
     * @return object array
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}
