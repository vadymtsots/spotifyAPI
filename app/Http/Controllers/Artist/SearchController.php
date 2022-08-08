<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Get(
 *     path="/api/artist/search-by-genre",
 *     description="Get the list of artists from db by genre",
 *     tags={"Artist"},
 *     @OA\Parameter(in="query", name="search", description="search", example="funk"),
 *     @OA\Response(
 *         response=200,
 *         description="Successful request",
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Validation exception, if search query is empty",
 *     ),
 * )
 *
 */
class SearchController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            Validator::validate($request->all(), [
                'search' => 'required|string'
            ]);

            $searchInput = $request->get('search');

            $artists = Artist::search($searchInput)->get()->pluck('name');

            return response()->json([
                'status' => 200,
                'data' => $artists
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'error' => $exception->getMessage()
            ], 500);
        }

    }
}
