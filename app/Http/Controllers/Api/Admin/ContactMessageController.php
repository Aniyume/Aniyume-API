<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Admin\Concerns\BuildsPaginationMeta;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminContactMessageResource;
use App\Models\AuditLog;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactMessageController extends Controller
{
    use BuildsPaginationMeta;

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'page' => ['sometimes', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'status' => ['sometimes', 'string', Rule::in([ContactMessage::STATUS_NEW, ContactMessage::STATUS_REVIEWED, ContactMessage::STATUS_RESOLVED, ContactMessage::STATUS_ARCHIVED])],
            'category' => ['sometimes', 'string', 'max:80'],
            'search' => ['sometimes', 'string', 'max:255'],
        ]);

        $query = ContactMessage::query()
            ->with(['user', 'admin'])
            ->when($validated['status'] ?? null, fn ($query, string $status) => $query->where('status', $status))
            ->when($validated['category'] ?? null, fn ($query, string $category) => $query->where('category', $category))
            ->when($validated['search'] ?? null, function ($query, string $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('subject', 'like', "%{$search}%")
                        ->orWhere('message', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%");
                });
            })
            ->latest();

        $paginator = $query->paginate($validated['per_page'] ?? 30)->withQueryString();

        return response()->json([
            'data' => AdminContactMessageResource::collection($paginator->getCollection())->resolve($request),
            'links' => $this->paginationLinks($paginator),
            'meta' => $this->paginationMeta($paginator),
        ]);
    }

    public function updateStatus(Request $request, ContactMessage $contact): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', Rule::in([ContactMessage::STATUS_NEW, ContactMessage::STATUS_REVIEWED, ContactMessage::STATUS_RESOLVED, ContactMessage::STATUS_ARCHIVED])],
            'admin_note' => ['nullable', 'string', 'max:3000'],
        ]);

        $contact->update([
            'status' => $validated['status'],
            'admin_id' => $request->user()?->id,
            'admin_note' => $validated['admin_note'] ?? $contact->admin_note,
            'resolved_at' => in_array($validated['status'], [ContactMessage::STATUS_RESOLVED, ContactMessage::STATUS_ARCHIVED], true) ? now() : $contact->resolved_at,
        ]);

        $this->audit($request, 'update_contact_message', "Changed contact message #{$contact->id} to {$validated['status']}");

        return response()->json(['data' => (new AdminContactMessageResource($contact->refresh()->load(['user', 'admin'])))->resolve($request)]);
    }

    public function photo(ContactMessage $contact)
    {
        abort_if(! $contact->photo, 404, 'Photo not found.');

        return response($contact->photo, 200, [
            'Content-Type' => $contact->photo_mime ?: 'application/octet-stream',
            'Content-Disposition' => 'inline; filename="'.addslashes($contact->photo_name ?: 'contact-photo').'"',
        ]);
    }

    public function destroy(Request $request, ContactMessage $contact): JsonResponse
    {
        $id = $contact->id;
        $contact->delete();
        $this->audit($request, 'delete_contact_message', "Deleted contact message #{$id}");

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
