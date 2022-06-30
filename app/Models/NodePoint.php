<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NodePoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'node_name',
        'allocated_ram',
        'total_ram',
        'allocated_disk',
        'total_disk',
        'created_at'
    ];

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Get the entries for the node.
     */
    public function entries()
    {
        return $this->hasMany(NodeStatsEntry::class, 'node_id');
    }
}
