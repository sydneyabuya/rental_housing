<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lease extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'leases';

    protected $dates = [
        'paid_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'amount_invoiced_id',
        'property_id',
        'unit_id',
        'paid',
        'paid_at',
        'status_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function applications()
    {
        return $this->belongsToMany(Application::class);
    }

    public function amount_invoiced()
    {
        return $this->belongsTo(Invoice::class, 'amount_invoiced_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function getPaidAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setPaidAtAttribute($value)
    {
        $this->attributes['paid_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function status()
    {
        return $this->belongsTo(Unit::class, 'status_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
