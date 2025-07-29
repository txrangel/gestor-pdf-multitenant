<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\OrderIndexRequest;
use App\Http\Requests\Api\v1\OrderUpdateRequest;
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
    ) {
    }
    /**
     * Display a listing of orders filtered by date.
     *
     * @param OrderIndexRequest $OrderIndexRequest
     * @return JsonResponse
     */
    public function index(OrderIndexRequest $OrderIndexRequest): JsonResponse
    {
        try {
            $orders = $this->orderService->getByDatesForAPI($OrderIndexRequest->start_date, $OrderIndexRequest->end_date);

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
    /**
     * @OA\Post(
     *     path="/api/v1/orders/update-erp-status",
     *     tags={"Orders"},
     *     summary="Update order status from ERP",
     *     description="Update order with ERP response (success or error)",
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"order_id","status"},
     *             @OA\Property(property="order_id", type="integer", example=1),
     *             @OA\Property(property="status", type="string", enum={"success", "error"}),
     *             @OA\Property(property="order_erp", type="string", example="ERP123456", description="Required if status=success"),
     *             @OA\Property(property="error_message", type="string", example="Product not found", description="Required if status=error")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Order updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/OrderResource")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Order not found"
     *     )
     * )
     */
    public function updateErpStatus(OrderUpdateRequest $request): JsonResponse
    {
        try {
            $order = $this->orderService->findById($request->order_id);
            if($order->export){
                return response()->json([
                        'error' => 'Falha ao atualizar pedido',
                        'message' => 'Pedido já exportado para o ERP'
                    ], 400);
            }else{
                if ($request->status === 'success') {
                    $order = $this->orderService->markAsExported(
                        orderId: $order->id,
                        erpNumber: $request->order_erp
                    );
                } else {
                    $order = $this->orderService->markAsFailed(
                        orderId: $order->id,
                        errorMessage: $request->error_message
                    );
                }
                return response()->json([
                    'message' => 'Pedido atualizado com sucesso',
                    'data' => new OrderResource($order)
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Falha ao atualizar pedido',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}