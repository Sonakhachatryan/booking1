<?php

namespace App\Http\Controllers\Admin\Restaurant;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Restaurant\RestaurantController;

use App\Models\Table;
use Illuminate\Http\Request;
use Session;

class TablesController extends RestaurantController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tables = Table::paginate(25);

        return view('restaurant.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('restaurant.tables.create');
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
            'people_count' => 'required|numeric',
            'count' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $requestData = $request->all();
        $requestData['restaurant_id'] = $this->restaurant->id;
        Table::create($requestData);

        Session::flash('success', 'Table added!');

        return redirect('/admin/restaurant/tables');
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
        $table = Table::findOrFail($id);

        return view('restaurant.tables.show', compact('table'));
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
        $table = Table::findOrFail($id);

        return view('restaurant.tables.edit', compact('table'));
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
        $this->validate($request,[
            'people_count' => 'required|numeric',
            'count' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $requestData = $request->all();
        
        $table = Table::findOrFail($id);
        $table->update($requestData);

        Session::flash('success', 'Table updated!');

        return redirect('admin/restaurant/tables');
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
        Table::destroy($id);

        Session::flash('success', 'Table deleted!');

        return redirect('admin/restaurant/tables');
    }
}
