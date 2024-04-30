<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Services\ReservationQueue;
use App\Services\ReservationQueueRabbitmq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $reservationsWithPagination = Reservation::orderByDesc('created_at')
            ->paginate(10);

        return response()->json($reservationsWithPagination, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $reservationData = $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'arrival_time' => 'required|date',
            'departure_time' => 'required|date'
        ]);

        $reservationData['reservation_code'] = uniqid();
        $reservationData['payment_status'] = 'pending'; // all new reservation payment status = pending

        $reservation = Reservation::create($reservationData);

        return response()->json($reservation, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        return response()->json($reservation, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ?Reservation $reservation)
    {
        $reservation->update($request->validate([
            'customer_name' => 'string',
            'customer_email' => 'email',
            'arrival_time' => 'date',
            'departure_time' => 'date',
            'payment_status' => 'string'
        ]));

        return response()->json($reservation, 200);
    }

}
