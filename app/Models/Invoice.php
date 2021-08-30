<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        'Pending'   => 'Pending',
        'Paid Some' => 'Paid Some',
        'Cleared'   => 'Cleared',
    ];

    public $table = 'invoices';

    protected $dates = [
        'due',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tenant_id',
        'billing_for',
        'amount',
        'due',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function tenant()
    {
        return $this->belongsTo(Application::class, 'tenant_id');
    }

    public function getDueAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDueAttribute($value)
    {
        $this->attributes['due'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
