<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\UserInfo;
use App\User;
use App\City;
use App\Governorate;
use Illuminate\Http\Request;

class UserInfoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user_infos = UserInfo::orderBy('id', 'desc')->paginate(10);

		return view('user_infos.index', compact('user_infos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('user_infos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$user_info = new UserInfo();
		$user_info->firstName = $request->input("firstName");
		$user_info->lastName = $request->input("lastName");
		$user_info->nationalid = $request->input("nationalid");
        $user_info->address = $request->input("address");
        $user_info->birthdate = $request->input("birthdate");
        $user_info->user_id = 1;
		$user_info->save();

		return redirect()->route('user_infos.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user_info = UserInfo::findOrFail($id);
		$user= User::findOrFail($id);
		$city= City::findOrFail($id);
		$gov= Governorate::findOrFail($id);
		return view('user_infos.show', compact('gov','city','user','user_info'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Request $request, $id)
	{
		$user_info = UserInfo::findOrFail($id);
		$user= User::findOrFail($id);
		$city= City::findOrFail($id);
		$gov= Governorate::findOrFail($id);
		return view('user_infos.edit', compact('gov','city','user','user_info'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$user_info = UserInfo::findOrFail($id);
		$user= User::findOrFail($id);
		$city_id=$user_info['city_id'];
		$gov_id=$user_info['governorate_id'];
		$gov= Governorate::findOrFail($gov_id);
		$city= City::findOrFail($city_id);
		$user_info->nationalid = $request->input("nationalid");
        $user_info->address = $request->input("address");
        $user_info->firstName = $request->input("firstName");
        $user_info->lastName = $request->input("lastName");
    	$city->name=$request->input("cityname");
        $user->email=$request->input("email");;
        $user_info->birthdate = $request->input("birthdate");
        $user->phone = $request->input("phone");
        $user->name = $request->input("username");
		$user_info->save();
		$user->save();
		$city->save();
		$gov->save();

		return redirect()->route('user_infos.show', $user_info->id)->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user_info = UserInfo::findOrFail($id);
		$user_info->delete();

		return redirect()->route('user_infos.index')->with('message', 'Item deleted successfully.');
	}

}