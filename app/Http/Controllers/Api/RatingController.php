<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\RatingRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    private $repository;

    public function __construct(RatingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $this->repository->find_all(),
        ];

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'movie_id' => 'required|integer',
                'rating' => 'required|integer'
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }

            $response = [
                'success' => true,
                'data' => $this->repository->insert($request->all())
            ];

            return response()->json($response);
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];

            return response()->json($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        try {
            $response = [
                'success' => true,
                'data' => $this->repository->find_by_id($id)
            ];

            return response()->json($response);
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];

            return response()->json($response);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'movie_id' => 'required|integer',
                'rating' => 'required|integer'
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }

            $response = [
                'success' => true,
                'data' => $this->repository->update_by_id($id, $request->all())
            ];

            return response()->json($response);
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];

            return response()->json($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $response = [
                'success' => true,
            ];

            $this->repository->delete($id);

            return response()->json($response);
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];

            return response()->json($response);
        }
    }
}
