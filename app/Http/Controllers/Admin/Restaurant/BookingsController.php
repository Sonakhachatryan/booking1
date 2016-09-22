<?php

namespace App\Http\Controllers\Admin\Restaurant;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\RestBooking;
use Illuminate\Http\Request;
use Session;

class BookingsController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $bookings = RestBooking::paginate(25);

        return view('restaurant.bookings.index', compact('bookings'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $booking = RestBooking::findOrFail($id);

        return view('restaurant.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $booking = RestBooking::findOrFail($id);

        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $booking = RestBooking::findOrFail($id);
        $booking->update($requestData);

        Session::flash('flash_message', 'Booking updated!');

        return redirect('bookings');
    }
}
