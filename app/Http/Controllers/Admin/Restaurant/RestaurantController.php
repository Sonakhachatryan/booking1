<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers\Admin\Restaurant;

use App\Http\Requests;
use App\Models\Admin;
use App\Models\Country;
use App\Models\City;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Jsonable;
use App\Models\Parking;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class RestaurantController extends AdminBaseController
{
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    protected $restaurant;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin:restaurant');
        
        $this->restaurant = Restaurant::with('parkings'/*,'offers'*/)->where('admin_id', $this->admin->id())->first();
        view()->share('restaurant',$this->restaurant);
    }

    public function getContactDetails()
    {
        return view('restaurant.contactDetails');
    }

    public function postContactDetails(Request $request)
    {
        $this->validate($request, [
            'address' => 'required',
            'email' => 'required|email|unique:restaurants,email,' . $this->restaurant->id,
            'phone' => 'required'
        ]);

        $this->restaurant->update($request->except('_token'));

        return back()->with('success', 'Contact details updated successfully.');

    }

    public function getLocation()
    {
        $countries = Country::all();

        $cities = City::where('country_id', $this->restaurant->country_id)->get();

        return view('restaurant.location', compact( 'countries', 'cities'));
    }

    public function postLocation(Request $request)
    {

        $this->validate($request, [
            'longitude' => 'required',
            'latitude' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
        ]);

        if ($this->restaurant->update($request->except('_token'))) ;
        return back()->with('success', 'Location details updated successfully.');

        return back()->withErrors('Something went wrong.');

    }

    public function getCity(Request $request)
    {
        $cities = City::where('country_id', $request->country_id)->get();

        return response()->json($cities);
    }

    public function getImages()
    {
        $this->restaurant->images = Image::where(['imageable_id' => $this->restaurant->id, 'imageable_type' => 'restaurant'])
            ->paginate(2);


        return view('restaurant.images', compact('restaurant'));
    }

    public function changeAvatar(Request $request)
    {
        if (!isset($request->avatar))
            return back();
        $this->validate($request, [
            'avatar' => 'image',
        ]);
        if (isset($request->avatar)) {
            $destinationPath = 'images/restaurants'; // upload path
            $extension = $request->avatar->getClientOriginalExtension(); // getting image extension
            $fileName = strtotime(Carbon::now()) . '.' . $extension; // renameing image
            $request->avatar->move($destinationPath, $fileName);


            if ($this->restaurant->avatar !== "" && file_exists($destinationPath . "/" . $this->restaurant->avatar)) {
                unlink($destinationPath . "/" . $this->restaurant->avatar);
            }

            $requestData['avatar'] = $fileName;
        }

        $this->restaurant->update($requestData);

        return back()->with('success', 'Logo updated successfully.');
    }

    public function addImage(Request $request)
    {
        dd($request->all());
        $this->validate($request, [
            'fileselect.*' => 'image'
        ]);

        $destinationPath = 'images/restaurants'; // upload path
        foreach ($request->fileselect as $file) {
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $fileName = strtotime(Carbon::now()) . '.' . $extension; // renameing image
            $file->move($destinationPath, $fileName);
            Image::create([
                'url' => $fileName,
                'imageable_id' => $this->restaurant->id,
                'imageable_type' => 'restaurant',
            ]);
        }

        return back()->with('success', 'Files uploaded successfully.');
    }

    public function removeImage($id, Request $request)
    {
        Image::destroy($id);
        return back()->with('success', 'Image remove successfully.');
    }


    public function parkingDetails()
    {
        return view('restaurant.parkingDetails');
    }

    public function editParkingDetails($id,Request $request)
    {
//        dd($request->all());
        if(!$this->hasAccess($id))
            return back();

        $this->validate($request,[
            'available' => 'required|numeric',
            'count' => 'required|numeric',
            'price' => 'required|numeric',
            'duration' => 'required',
        ]);

        if(Parking::find($id) -> update($request->except('_token')))
            return back()->with('success','Parking updated successfully.');

        return back()->with('error','Something went wrong.');
    }
    
    public function getCreateParkingDetails()
    {
        return view('restaurant.createParkingDetails');
    }

    public function postCreateParkingDetails(Request $request)
    {
        $this->validate($request,[
            'available' => 'required|numeric',
            'count' => 'required|numeric',
            'price' => 'required|numeric',
            'duration' => 'required',
        ]);

        $data = $request->except('_token');
        $data['parkingable_id'] = $this->restaurant->id;
        $data['parkingable_type'] = 'App\Models\Restaurant';

        if(Parking::create($data))
            return redirect('admin/restaurant/parking-details')->with('success','Parking created successfully.');

        return redirect('admin/restaurant/parking-details')->with('error','Something went wrong.');
    }

    public function deleteParkingDetails($id)
    {
        if(!$this->hasAccess($id))
            return back();

        if( Parking::destroy($id))
            return redirect('admin/restaurant/parking-details')->with('success','Parking deleted successfully.');

        return redirect('admin/restaurant/parking-details')->with('error','Something went wrong.');

    }

    public function hasAccess($id)
    {
        $parking = Parking::find($id);

        return $parking->parkingable_type == 'App\Models\Restaurant' && $parking->parkingable_id == $this->restaurant->id;
    }
    
    
}