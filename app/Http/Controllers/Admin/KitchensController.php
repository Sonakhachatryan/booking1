<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Kitchen;
use Illuminate\Http\Request;
use Session;

class KitchensController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $kitchens = Kitchen::paginate(25);

        return view('admin.kitchens.index', compact('kitchens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.kitchens.create');
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
            'name' => 'required',
        ]);

        $requestData = $request->all();
        
        Kitchen::create($requestData);

        Session::flash('success', 'Kitchen added!');

        return redirect('admin/kitchens');
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
        $kitchen = Kitchen::findOrFail($id);

        return view('admin.kitchens.show', compact('kitchen'));
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
        $kitchen = Kitchen::findOrFail($id);

        return view('admin.kitchens.edit', compact('kitchen'));
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
            'name' => 'required',
        ]);

        $requestData = $request->all();
        
        $kitchen = Kitchen::findOrFail($id);
        $kitchen->update($requestData);

        Session::flash('success', 'Kitchen updated!');

        return redirect('admin/kitchens');
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
        Kitchen::destroy($id);

        Session::flash('success', 'Kitchen deleted!');

        return redirect('admin/kitchens');
    }
}
