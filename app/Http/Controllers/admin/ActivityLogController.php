<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of activity logs
     */
    public function index(Request $request)
    {
        $query = ActivityLog::query();

        // Default: hanya tampilkan tipe-tipe yang diminta (sederhana)
        $allowedTypes = [
            'login', 'logout',
            'create', 'update', 'delete',
            'apply', 'return',
            'approve', 'reject'
        ];

        // Jika user tidak memberikan filter activity_type, batasi ke allowed
        if (!$request->filled('activity_type')) {
            $query->whereIn('activity_type', $allowedTypes);
        } else {
            $query->where('activity_type', $request->activity_type);
        }

        // Filter by user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::createFromFormat('Y-m-d', $request->start_date)->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Simple search by description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('description', 'like', "%$search%");
        }

        // Get all users for filter dropdown
        $users = User::orderBy('name')->get();

        // Activity types shown in dropdown (labelled)
        $activityTypes = collect($allowedTypes)->mapWithKeys(function ($t) {
            return [$t => \App\Models\ActivityLog::labelFor($t)];
        });

        // Paginate results (8 per page)
        $activityLogs = $query->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('admin.activity-logs.index', compact(
            'activityLogs',
            'users',
            'activityTypes'
        ));
    }

    /**
     * Show report of activity logs
     */
    public function report(Request $request)
    {
        $startDate = $request->start_date ? Carbon::createFromFormat('Y-m-d', $request->start_date)->startOfDay() : now()->subMonth();
        $endDate = $request->end_date ? Carbon::createFromFormat('Y-m-d', $request->end_date)->endOfDay() : now();

        // Statistics
        $totalActivities = ActivityLog::whereBetween('created_at', [$startDate, $endDate])->count();
        $activitiesByType = ActivityLog::whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('activity_type')
            ->selectRaw('activity_type, count(*) as total')
            ->pluck('total', 'activity_type');

        $activitiesByModule = ActivityLog::whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('module')
            ->selectRaw('module, count(*) as total')
            ->pluck('total', 'module');

        $activitiesByUser = ActivityLog::whereBetween('created_at', [$startDate, $endDate])
            ->with('user')
            ->groupBy('user_id')
            ->selectRaw('user_id, count(*) as total')
            ->get()
            ->map(function ($item) {
                return [
                    'user' => $item->user ? $item->user->name : 'Unknown',
                    'total' => $item->total,
                ];
            });

        return view('admin.activity-logs.report', compact(
            'totalActivities',
            'activitiesByType',
            'activitiesByModule',
            'activitiesByUser',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Export activity logs to CSV
     */
    public function export(Request $request)
    {
        $query = ActivityLog::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::createFromFormat('Y-m-d', $request->start_date)->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $logs = $query->with('user')->orderBy('created_at', 'desc')->get();

        $filename = 'activity-logs-' . now()->format('Y-m-d-H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($logs) {
            $file = fopen('php://output', 'w');
            
            // Header CSV
            fputcsv($file, [
                'ID',
                'User',
                'Activity Type',
                'Module',
                'Description',
                'Model Type',
                'Model ID',
                'IP Address',
                'Created At',
            ]);

            // Data
            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->id,
                    $log->user ? $log->user->name : 'Unknown',
                    $log->activity_type,
                    $log->module,
                    $log->description,
                    $log->model_type,
                    $log->model_id,
                    $log->ip_address,
                    $log->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Delete old activity logs
     */
    public function cleanup(Request $request)
    {
        $days = $request->days ?? 90;
        $date = now()->subDays($days);

        $deleted = ActivityLog::where('created_at', '<', $date)->delete();

        return response()->json([
            'message' => "Deleted $deleted activity logs older than $days days",
            'deleted' => $deleted,
        ]);
    }
}
