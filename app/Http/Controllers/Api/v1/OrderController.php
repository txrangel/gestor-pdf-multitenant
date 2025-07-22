<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\OrderIndexRequest;
use App\Http\Resources\Api\V1\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Get(
 *     path="/api/orders",
 *     tags={"Orders"},
 *     summary="Get orders by date range",
 *     description="Returns a list of orders filtered by date range",
 *     security={{"sanctum": {}}},
 *     @OA\Parameter(
 *         name="start_date",
 *         in="query",
 *         required=true,
 *         @OA\Schema(type="string", format="date", example="2023-01-01")
 *     ),
 *     @OA\Parameter(
 *         name="end_date",
 *         in="query",
 *         required=true,
 *         @OA\Schema(type="string", format="date", example="2023-12-31")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/OrderCollection")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server error"
 *     )
 * )
 */
class OrderController extends Controller
{
    public function __construct(
        private OrderService $orderService
    ) {}
    /**
     * Display a listing of orders filtered by date.
     *
     * @param OrderIndexRequest $OrderIndexRequest
     * @return JsonResponse
     */
    public function index(OrderIndexRequest $OrderIndexRequest): JsonResponse
    {
        try {
            $orders = $this->orderService->getByDates($OrderIndexRequest->start_date,$OrderIndexRequest->end_date);

            return response()->json([
                'data' => OrderResource::collection($orders),
                'meta' => [
                    'total' => $orders->count(),
                    'start_date' => $OrderIndexRequest->start_date,
                    'end_date' => $OrderIndexRequest->end_date,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to retrieve orders',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}