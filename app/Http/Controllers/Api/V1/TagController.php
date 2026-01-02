<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * @group Публичные данные
 */
class TagController extends Controller
{
    /**
     * Список тегов
     *
     * Возвращает список всех жанров и категорий аниме.
     * @queryParam search string Поиск по названию тега. Example: Action
     */
    public function index(Request $request)
    {
        $query = Tag::query();

        if ($request->filled('search')) {
            $query->where('name', 'ILIKE', '%'.$request->search.'%')
                ->orWhere('slug', 'ILIKE', '%'.$request->search.'%');
        }

        $tags = $query->orderBy('name', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => $tags->map(function ($tag) {
                return [
                    'id' => $tag->id,
                    'name' => $tag->name,
                    'slug' => $tag->slug,
                ];
            }),
            'total' => $tags->count(),
        ]);
    }

    /**
     * Детали тега
     * @urlParam id integer ID тега. Example: 1
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);

        return new TagResource($tag);
    }
}
