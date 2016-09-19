<?php

namespace App\Http\Controllers\Admin\Restaurant;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Restaurant;
use App\Models\Offer;
use Illuminate\Http\Request;
use Session;

class OffersController extends RestaurantController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $offers = $this->restaurant->offers()->paginate(2);
        
        return view('restaurant.offers.index',compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('restaurant.offers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
        ]);

        $data = $request->except('_token');
        $data['offerable_id'] = $this->restaurant->id;
        $data['offerable_type']  = 'App\Models\Restaurant';

        Offer::create($data);

        Session::flash('success', 'Offer added!');

        return redirect('admin/restaurant/offers');
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
        if(!$this->hasAccess($id))
        return back();

        $offer = Offer::findOrFail($id);

        return view('restaurant.offers.show', compact('offer'));
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
        if(!$this->hasAccess($id))
            return back();

        $offer = Offer::findOrFail($id);

        return view('restaurant.offers.edit', compact('offer'));
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
        if(!$this->hasAccess($id))
            return back();

        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
        ]);
        $requestData = $request->all();

        $offer = Offer::findOrFail($id);
        $offer->update($requestData);

        Session::flash('success', 'Offer updated!');

        return redirect('admin/restaurant/offers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if(!$this->hasAccess($id))
            return back();

        Offer::destroy($id);

        Session::flash('success', 'Offer deleted!');

        return redirect('admin/restaurant/offers');
    }

    public function hasAccess($id)
    {
        $offer = Offer::find($id);

        return $offer->offerable_type == 'App\Models\Offer' && $offer->offerable_id == $this->restaurant->id;
    }
}
