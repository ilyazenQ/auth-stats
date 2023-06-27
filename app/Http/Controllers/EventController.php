<?php

namespace App\Http\Controllers;

use App\Actions\Event\CreateEventAction;
use App\Actions\Event\GetEventStatsAction;
use App\Http\Requests\Event\CreateEventRequest;
use App\Http\Requests\Event\GetEventStatsRequest;
use OpenApi\Annotations as OA;

class EventController extends Controller
{
     /**
     * @OA\Post(
     *      path="/api/events/",
     *      tags={"Events"},
     *      summary="Save new event stats",
     *      @OA\RequestBody(
     *          required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="button_click"),
     *             @OA\Property(property="is_auth", type="bool", example=true))
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful created",
     *       @OA\JsonContent(
     *             @OA\Property(property="code", type="int", example=201),
     *             @OA\Property(property="data", type="object", example={
     *              "name": "button_click",
     *               "is_auth": true,
     *               "ip": "000.00.0.1",
     *               "updated_at": "2023-05-07T05:19:19.000000Z",
     *               "created_at": "2023-05-07T05:19:19.000000Z",
     *               "id": 17
     *              }))
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function save(CreateEventRequest $request, CreateEventAction $action)
    {

        return response()->json([
            'code' => 201,
            'data' => $action->execute($request->validated())], 201);
    }

    /**
     * @OA\Get(
     *      path="/api/events/stats",
     *      tags={"Events"},
     *      summary="Get stats by filters",
     *    @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Name of the event",
     *         required=true,
     *         @OA\Schema(type="string", example="button_click")
     *     ),     
     *    @OA\Parameter(
     *         name="date_from",
     *         in="query",
     *         description="Date from",
     *         required=true,
     *         @OA\Schema(type="string", example="2022-02-25 15:30:00")
     *     ), 
     *    @OA\Parameter(
     *         name="date_to",
     *         in="query",
     *         description="Date to",
     *         required=true,
     *         @OA\Schema(type="string", example="2024-02-25 15:30:00")
     *     ), 
     *    @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="Type to filter. Available types: by_ip, by_auth_status, by_event_name",
     *         required=true,
     *         @OA\Schema(type="string", example="by_auth_status")
     *     ), 
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *       @OA\JsonContent(
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="data", type="array", @OA\Items(type="object"))
     *             )
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function getStats(GetEventStatsRequest $request, GetEventStatsAction $action)
    {
        return response()->json([
            'code' => 200,
            'data' => $action->execute($request->validated())]);
    }
}
