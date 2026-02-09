<?php

namespace App\Traits;

use App\Models\ActivityLog;

trait ActivitylogTrait
{
    /**
     * Log aktivitas create
     */
    public function logCreate($module, $model_type, $model_id, $model_data, $description = null)
    {
        $description = $description ?? "Membuat data $module baru";
        
        ActivityLog::log(
            'create',
            $description,
            $module,
            $model_type,
            $model_id,
            null,
            $model_data
        );
    }

    /**
     * Log aktivitas update
     */
    public function logUpdate($module, $model_type, $model_id, $old_data, $new_data, $description = null)
    {
        $description = $description ?? "Mengubah data $module";
        
        ActivityLog::log(
            'update',
            $description,
            $module,
            $model_type,
            $model_id,
            $old_data,
            $new_data
        );
    }

    /**
     * Log aktivitas delete
     */
    public function logDelete($module, $model_type, $model_id, $model_data, $description = null)
    {
        $description = $description ?? "Menghapus data $module";
        
        ActivityLog::log(
            'delete',
            $description,
            $module,
            $model_type,
            $model_id,
            $model_data,
            null
        );
    }

    /**
     * Log aktivitas view
     */
    public function logView($module, $description = null)
    {
        $description = $description ?? "Melihat daftar $module";
        
        ActivityLog::log(
            'view',
            $description,
            $module
        );
    }

    /**
     * Log aktivitas custom
     */
    public function logActivity($activity_type, $module, $description, $model_type = null, $model_id = null)
    {
        ActivityLog::log(
            $activity_type,
            $description,
            $module,
            $model_type,
            $model_id
        );
    }
}
