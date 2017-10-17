<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditTrail extends Model
{
    use SoftDeletes;

    /**
     * Audit trails table.
     *
     * @var string
     */
    protected $table = 'audit_trails';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id', 'module', 'description'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The audit trail belongs to a admin.
     *
     * @return object
     */
    public function admin()
    {
        return $this->belongsTo(Admins::class);
    }
}
