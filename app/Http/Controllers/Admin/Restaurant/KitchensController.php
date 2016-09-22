<?php

namespace App\Http\Controllers\Admin\Restaurant;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Restaurant;
use App\Models\Kitchen;
use App\Models\RestaurantKitchen;
use Illuminate\Http\Request;
use Session;

class KitchensController extends RestaurantController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    protected $paginate=15;

    public function index()
    {
        $restKitchens = $this->restaurant->kitchens()->paginate($this->paginate);
        $kitchens = Kitchen::with('restaurants')->get();
        $kitchens = $kitchens->filter(function($kitchen){
            foreach($kitchen->restaurants as $restaurant)
                if($restaurant->id == $this->restaurant->id)
                    return false;
            return true;
        });
        
        return view('restaurant.kitchens.index',compact('kitchens','restKitchens'));
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
        foreach($request->kitchens as $kitchen)
          RestaurantKitchen::create(['kitchen_id' => $kitchen, 'restaurant_id' => $this->restaurant->id]);

        Session::flash('success', 'Kitchens added!');

        return redirect('admin/restaurant/kitchens');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id,Request $request)
    {
        RestaurantKitchen::where(['kitchen_id' => $id, 'restaurant_id' => $this->restaurant->id ])->delete();

        Session::flash('success', 'Kitchen deleted!');

        $current_page=$request->input('current_page');

        $count = $this->restaurant->kitchens()->count();

        $count = ceil($count/$this->paginate);
        if($current_page>$count){
            $current_page = $count;
        }

        return redirect('admin/restaurant/kitchens?page=' . $current_page);
    }
}
