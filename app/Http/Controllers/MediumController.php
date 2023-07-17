<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medium;
use App\Http\Resources\MediumResource;

class MediumController extends Controller
{
    public function index(Request $request) {

        $media = Medium::all();

        if (!is_null($request->fulltext)) {
            $media = Medium::whereHas('mediable', function ($query) use ($request) {
                $query->where('name', 'like', "%$request->fulltext%");
            })->get();
        }

        $count = $media->count();

        if (!is_null($request->offset)) {
            $limit = 12;
            $media = $media->skip($limit * ($request->offset - 1))->take($limit);
        }

        return json_encode([
            'data' => MediumResource::collection($media),
            'totalCount' => $count,
        ]);
    }

    public function show(string $id) {
        return new MediumResource(Medium::findOrFail($id));
    }
}
