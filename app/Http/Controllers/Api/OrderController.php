<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use App\DTO\OrderDTO;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Order API",
 *     description="API для заказов",
 *     @OA\Contact(
 *         email="support@example.com"
 *     )
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Local API server"
 * )
 *
 * Class OrderController
 *
 * Контроллер для управления заказами.
 *
 * @package App\Http\Controllers\Api
 */
class OrderController extends Controller {

    /**
     * OrderController constructor.
     *
     * @param OrderService $service
     */
    public function __construct(protected OrderService $service) {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/orders",
     *     summary="Создание нового заказа",
     *     tags={"Orders"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"customer_name", "customer_email", "products"},
     *             @OA\Property(property="customer_name", type="string", example="Тест Тестович"),
     *             @OA\Property(property="customer_email", type="string", format="email", example="test@example.com"),
     *             @OA\Property(
     *                 property="products",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     required={"product_id", "quantity"},
     *                     @OA\Property(property="product_id", type="integer", example=1),
     *                     @OA\Property(property="quantity", type="integer", minimum=1, example=2)
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешное создание заказа",
     *         @OA\JsonContent(ref="#/components/schemas/OrderResource")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации"
     *     )
     * )
     *
     * Создание нового заказа.
     *
     * @param StoreOrderRequest $request
     * @return OrderResource
     */
    public function store(StoreOrderRequest $request) {
        $dto = new OrderDTO($request->validated());
        $order = $this->service->createOrder($dto);
        return (new OrderResource($order));
    }

    /**
     * @OA\Get(
     *     path="/api/orders/{id}",
     *     summary="Получить заказ по ID",
     *     tags={"Orders"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID заказа",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Информация о заказе",
     *         @OA\JsonContent(ref="#/components/schemas/OrderResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Заказ не найден"
     *     )
     * )
     *
     * Получение заказа по ID.
     *
     * @param int $id
     * @return JsonResponse|OrderResource
     */
    public function show(int $id) {
        $order = $this->service->getOrder($id);
        if (!$order) return response()->json(['message' => 'Order Not Found'], 404);
        return new OrderResource($order);
    }
}
