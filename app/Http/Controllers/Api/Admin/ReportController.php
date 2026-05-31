<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Admin\Concerns\BuildsPaginationMeta;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminReportResource;
use App\Models\AuditLog;
use App\Models\Report;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\AuditService;

class ReportController extends Controller
{
    use BuildsPaginationMeta;

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'page' => ['sometimes', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'status' => ['sometimes', 'string', Rule::in([Report::STATUS_PENDING, Report::STATUS_REVIEWED, Report::STATUS_RESOLVED, Report::STATUS_REJECTED])],
            'category' => ['sometimes', 'string', 'max:80'],
            'target_type' => ['sometimes', 'string', 'max:255'],
            'reporter_id' => ['sometimes', 'integer', 'exists:users,id'],
        ]);

        $query = Report::query()
            ->with(['reporter', 'admin', 'target'])
            ->when($validated['status'] ?? null, fn ($query, string $status) => $query->where('status', $status))
            ->when($validated['category'] ?? null, fn ($query, string $category) => $query->where('category', $category))
            ->when($validated['target_type'] ?? null, fn ($query, string $targetType) => $query->where('target_type', $targetType))
            ->when($validated['reporter_id'] ?? null, fn ($query, int $reporterId) => $query->where('reporter_id', $reporterId))
            ->latest();

        $paginator = $query->paginate($validated['per_page'] ?? 20)->withQueryString();

        return response()->json([
            'data' => AdminReportResource::collection($paginator->getCollection())->resolve($request),
            'links' => $this->paginationLinks($paginator),
            'meta' => $this->paginationMeta($paginator),
        ]);
    }

    public function show(Request $request, Report $report): JsonResponse
    {
        return response()->json([
            'data' => (new AdminReportResource($report->load(['reporter', 'admin', 'target'])))->resolve($request),
        ]);
    }

    public function updateStatus(Request $request, Report $report): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', Rule::in([Report::STATUS_PENDING, Report::STATUS_REVIEWED, Report::STATUS_RESOLVED, Report::STATUS_REJECTED])],
            'resolution_note' => ['nullable', 'string', 'max:2000'],
        ]);

        $before = $report->getOriginal();
        $report->update([
            'status' => $validated['status'],
            'admin_id' => $request->user()?->id,
            'resolution_note' => $validated['resolution_note'] ?? $report->resolution_note,
            'resolved_at' => in_array($validated['status'], [Report::STATUS_RESOLVED, Report::STATUS_REJECTED], true) ? now() : $report->resolved_at,
        ]);

        app(AuditService::class)->log($request, 'update_report_status', "Changed report #{$report->id} status to {$validated['status']}", $report, $before, $report->fresh()->toArray());

        return response()->json([
            'data' => (new AdminReportResource($report->refresh()->load(['reporter', 'admin', 'target'])))->resolve($request),
        ]);
    }

    public function destroy(Request $request, Report $report): JsonResponse
    {
        $id = $report->id;
        $report->delete();
        $this->audit($request, 'delete_report', "Deleted report #{$id}");

        return response()->json(null, 204);
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
