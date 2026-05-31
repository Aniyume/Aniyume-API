<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Admin\Concerns\BuildsPaginationMeta;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ListAdminImportLogsRequest;
use App\Http\Requests\Admin\RunAdminImportRequest;
use App\Http\Resources\AdminImportLogResource;
use App\Jobs\ImportAnimeJob;
use App\Models\AuditLog;
use App\Models\ImportLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    use BuildsPaginationMeta;

    public function dashboard(): JsonResponse
    {
        $latestImport = ImportLog::latest()->first();

        return response()->json([
            'data' => [
                'latest_import' => $latestImport ? (new AdminImportLogResource($latestImport))->resolve(request()) : null,
                'stats' => [
                    'total_imports' => ImportLog::count(),
                    'successful_imports' => ImportLog::where('status', 'completed')->count(),
                    'failed_imports' => ImportLog::where('status', 'failed')->count(),
                    'running_imports' => ImportLog::where('status', 'running')->count(),
                ],
            ],
        ]);
    }

    public function logs(ListAdminImportLogsRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $sort = $validated['sort'] ?? 'created_at';
        $sortColumn = $sort === 'completed_at' ? 'finished_at' : $sort;
        $direction = $validated['direction'] ?? 'desc';

        $query = ImportLog::query()
            ->when($validated['status'] ?? null, fn ($query, string $status) => $query->where('status', $status))
            ->when($validated['type'] ?? null, fn ($query, string $type) => $query->where('import_type', $type))
            ->orderBy($sortColumn, $direction);

        $paginator = $query->paginate($validated['per_page'] ?? 20)->withQueryString();

        return response()->json([
            'data' => AdminImportLogResource::collection($paginator->getCollection())->resolve($request),
            'links' => $this->paginationLinks($paginator),
            'meta' => $this->paginationMeta($paginator),
        ]);
    }

    public function run(RunAdminImportRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $isInitialImport = $validated['type'] === 'initial';

        $runningImport = ImportLog::where('status', 'running')
            ->whereIn('import_type', ['initial', 'update'])
            ->latest()
            ->first();

        if ($runningImport) {
            return response()->json([
                'message' => 'Anime import is already running',
                'data' => (new AdminImportLogResource($runningImport))->resolve($request),
            ], 409);
        }

        $importLog = ImportLog::create([
            'import_type' => $validated['type'],
            'started_at' => now(),
            'status' => 'running',
        ]);

        ImportAnimeJob::dispatch(1, $isInitialImport, $importLog->id);

        $this->audit($request, 'run_import', "Started {$validated['type']} import (Log ID: {$importLog->id})");

        return response()->json([
            'data' => (new AdminImportLogResource($importLog))->resolve($request),
        ], 202);
    }

    private function audit(Request $request, string $action, string $description): void
    {
        AuditLog::create([
            'user_id' => $request->user()?->id,
            'action' => $action,
            'description' => $description,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'created_at' => now(),
        ]);
    }
}
