<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workorder extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        'Ongoing' => 'Ongoing',
        'Closed'  => 'Closed',
    ];

    public $table = 'workorders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'vendor_id',
        'vendor_spec_id',
        'details_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function vendor_spec()
    {
        return $this->belongsTo(Vendor::class, 'vendor_spec_id');
    }

    public function details()
    {
        return $this->belongsTo(Maintenance::class, 'details_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
