<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NodeStatsEntry extends Model
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

     public function node(){
        return $this->belongsTo(NodePoint::class, 'node_id');
    }
}
