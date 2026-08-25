<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ServiceRequestRequest;

class ServiceRequestController extends Controller
{
    use ApiResponse;
    public function store(ServiceRequestRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {

            // Add default status
            $validated['status'] = 'pending';

            // Remove images before creating ServiceRequest
            unset($validated['images']);

            $serviceRequest = ServiceRequest::create($validated);

            // Upload Images
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $image) {

                    $path = $image->store(
                        'service-requests',
                        'public'
                    );

                    $serviceRequest->images()->create([
                        'image' => $path,
                    ]);
                }
            }

            DB::commit();

            return $this->successMessage(
                'تم إرسال طلب الخدمة بنجاح',
                201
            );
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'حدث خطأ أثناء إرسال الطلب',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
