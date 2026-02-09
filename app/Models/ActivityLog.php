<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_type',
        'description',
        'module',
        'model_type',
        'model_id',
        'old_value',
        'new_value',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'old_value' => 'json',
        'new_value' => 'json',
    ];

    /**
     * Get the user who performed the activity
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk filter by user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope untuk filter by activity type
     */
    public function scopeByActivityType($query, $type)
    {
        return $query->where('activity_type', $type);
    }

    /**
     * Scope untuk filter by module
     */
    public function scopeByModule($query, $module)
    {
        return $query->where('module', $module);
    }

    /**
     * Scope untuk filter by date range
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    /**
     * Static method untuk log aktivitas
     */
    public static function log($activity_type, $description, $module, $model_type = null, $model_id = null, $old_value = null, $new_value = null)
    {
        return static::create([
            'user_id' => auth()->id(),
            'activity_type' => $activity_type,
            'description' => $description,
            'module' => $module,
            'model_type' => $model_type,
            'model_id' => $model_id,
            'old_value' => $old_value,
            'new_value' => $new_value,
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);
    }

    /**
     * Get activity type badge color
     */
    public function getActivityTypeBadgeColor()
    {
        return match($this->activity_type) {
            'create' => 'success',
            'update' => 'warning',
            'delete' => 'danger',
            'view' => 'info',
            'login' => 'primary',
            'logout' => 'secondary',
            'approve' => 'success',
            'reject' => 'danger',
            'activate' => 'success',
            'deactivate' => 'danger',
            'apply' => 'info',
            'apply_return' => 'info',
            'return' => 'primary',
            default => 'secondary',
        };
    }

    /**
     * Human readable label for activity type
     */
    public function actionLabel()
    {
        return static::labelFor($this->activity_type);
    }

    public static function labelFor($type)
    {
        return match($type) {
            'create' => 'Tambah',
            'delete' => 'Hapus',
            'update' => 'Edit',
            'view' => 'Melihat',
            'login' => 'Login',
            'logout' => 'Logout',
            'approve' => 'Mengkonfirmasi',
            'reject' => 'Menolak',
            'activate' => 'Aktifkan',
            'deactivate' => 'Nonaktifkan',
            'apply' => 'Meminjam',
            'apply_return' => 'Mengembalikan',
            'return' => 'Mengembalikan',
            default => ucfirst(str_replace('_', ' ', $type)),
        };
    }

    /**
     * Get modified fields (changes between old and new)
     */
    public function getModifiedFields()
    {
        if (!$this->old_value || !$this->new_value) {
            return [];
        }

        $modified = [];
        foreach ($this->new_value as $key => $newVal) {
            $oldVal = $this->old_value[$key] ?? null;
            if ($oldVal !== $newVal) {
                $modified[$key] = [
                    'old' => $oldVal,
                    'new' => $newVal,
                ];
            }
        }

        return $modified;
    }
}
