<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *   name="Division",
 *   description="Routes for Divisions"
 *
 * )
 */
class DivisionController extends Controller
{


    /**
     * @OA\Get(
     *   tags={"Division"},
     *   path="division",
     *   summary="Get divisions list",
     *
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */

    public function index()
    {
        $divisions = Division::withCount('subDivisions')->with('subDivisions', 'parentDivision')->get();
        return response()->json($divisions, 200);
    }

    /**
     * @OA\Post(
     *   tags={"Division"},
     *   path="division",
     *   summary="Register division.",
     *   @OA\RequestBody(
     *     required=true,
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *               type="object",
     *                 ref="#/components/schemas/Division",
     *            ),
     *        )
     *   ),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function store(Request $request)
    {
        $division=Division::create($request->all());
        return response()->json(['message'=>'Division creada']);
    }

    /**
     * @OA\Get(
     *   tags={"Division"},
     *   path="division/{id}",
     *   summary="Get a single division",
     *    @OA\Parameter(
     *         description="Divisionn Id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="int"),
     *     ),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show($id)
    {
        $division=Division::find($id);
        return response()->json($division, 200);
    }

    /**
     * @OA\Put(
     *   tags={"Division"},
     *   path="division/{id}",
     *   summary="Update a divisionz",
     *    @OA\Parameter(
     *         description="Divisionn Id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="int"),
     *     ),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function update(Request $request, $id)
    {
        $division=Division::findOrFail($id);
        $division->update($request->all());

        return response()->json(['message'=>'Division actualizada']);
    }

    /**
     * @OA\Delete(
     *   tags={"Division"},
     *   path="quizz/{id}",
     *   summary="Delete a quizz",
     *    @OA\Parameter(
     *         description="Divisionn Id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="int"),
     *     ),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function destroy($id)
    {
        try {
            $division=Division::findOrFail();
            $division->delete();
        } catch (\Exception $e) {
            return response()->json(['message'=>'No se puede  eliminar el registro','detail'=>$e->getMessage()], 422);
        }
    }

    /**
     * @OA\Get(
     *   tags={"Division"},
     *   path="division/{id}/sub-divisions",
     *   summary="Get a  division subdivisions",
     *    @OA\Parameter(
     *         description="Divisionn Id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="int"),
     *     ),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function showSubdivisions($id)
    {
        $division=Division::with('subDivisions')->findOrFail($id);
        return response()->json($division, 200);
    }
}
