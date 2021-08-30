<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        'Vacant'   => 'Vacant',
        'Occupied' => 'Occupied',
    ];

    public $table = 'units';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'property_id',
        'rent',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function statusLeases()
    {
        return $this->hasMany(Lease::class, 'status_id', 'id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function property_units()
    {
        return $this->belongsToMany(Property::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
