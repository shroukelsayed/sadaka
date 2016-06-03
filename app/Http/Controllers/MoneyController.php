<?php namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use DB;
use App\Person;
use App\PersonInfo;
use App\DonationType;
use App\IntervalType;
use App\Governorate;
use App\City;
use Carbon\Carbon;
use App\PersonStatus;
use Validator;

use App\Money;
use Illuminate\Http\Request;

class MoneyController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$money = Money::orderBy('id', 'desc')->paginate(10);

		return view('money.index', compact('money'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$interval_types = IntervalType::all();
		$governorates = Governorate::all();
		$cities = City::all();

		return view('money.create',compact('interval_types','governorates','cities'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
	        'name' => 'required|max:255',
	        'address' => 'required',
	        'birthdate' => 'required',
	        'gender' => 'required',
	        'maritalstatus' => 'required',
	        'phone' => 'required',
	        'city_id' => 'required',
	        'governorate_id' => 'required',
	        'amount' => 'required'

    	]);
		// Creating Case Data .. --> by shrouk
		// Start transaction!
		DB::beginTransaction();

		try {
			//first stage:
			//creating PersonInfo Object ...
			$person_info = new PersonInfo();
			$person_info->name = $request->input("name");
	        $person_info->address = $request->input("address");
	        $person_info->birthDate = $request->input("birthdate");
	        $person_info->gender = $request->input("gender");
	        $person_info->maritalstatus = $request->input("maritalstatus");
	        $person_info->phone = $request->input("phone");
	        $person_info->city_id = $request->city_id;
	        $person_info->governorate_id = $request->governorate_id;
			$person_info->save();

		} catch(ValidationException $e)
		{
		    // Rollback and then redirect
		    // back to form with errors
		    DB::rollback();
		    return Redirect::to('/form')
		        ->withErrors( $e->getErrors() )
		        ->withInput();
		} catch(\Exception $e)
		{
		    DB::rollback();
		    throw $e;
		}

		try{
			//second stage:
			//creating Person Object ...
			$person = new Person();
			$person->user_id = Auth::user()->id;  // Getting User from Session ..
			$person->person_info_id = $person_info->id;
			$person->publishat = Carbon::now();

			// Third stage:
			// Setting DonationType Object ...
			// Donation Type = Money .. Money must be stored in DB  with id = 2
			$person->donation_type_id = 2; 

			//fourth stage:
			//setting IntervalType Object ...
			$person->interval_type_id = $request->interval_type_id;

			//fifth stage:
			//setting PersonStatus Object ...
			$person->person_status_id = 1; // Default Waiting Status of new case ..
			$person->save();
		} catch(ValidationException $e)
		{
		    // Rollback and then redirect
		    // back to form with errors
		    DB::rollback();
		    return Redirect::to('/form')
		        ->withErrors( $e->getErrors() )
		        ->withInput();
		} catch(\Exception $e)
		{
		    DB::rollback();
		    throw $e;
		}

		try{
			//sixth stage:
			//creating Donation Object ...
			$money = new Money();
			$money->amount = $request->input("amount");
			$money->person_id = $person->id;
			$money->save();

		} catch(ValidationException $e)
		{
		    // Rollback and then redirect
		    // back to form with errors
		    DB::rollback();
		    return Redirect::to('/form')
		        ->withErrors( $e->getErrors() )
		        ->withInput();
		} catch(\Exception $e)
		{
		    DB::rollback();
		    throw $e;
		}

		// If we reach here, then
		// data is valid and working.
		// Commit the queries!
		DB::commit();
		return redirect()->route('money.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$money = Money::findOrFail($id);

		return view('money.show', compact('money'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{	
		$money = Money::findOrFail($id);

		$interval_types = IntervalType::all();
		$governorates = Governorate::all();
		$cities = City::all();
		$status = PersonStatus::all();

		return view('money.edit', compact('money','interval_types','governorates','cities','status'));
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
		// First Stage:
		// Getting Case with it's all info ..
		$money = Money::findOrFail($id);

		$person = Person::findOrFail($money->person_id);
		$person_info = PersonInfo::findOrFail($person->id);

		// Second Stage:
		// Getting new Data .. 
		$person_info->name = $request->input("name");
        $person_info->address = $request->input("address");
        $person_info->birthDate = $request->input("birthdate");
        $person_info->gender = $request->input("gender");
        $person_info->maritalstatus = $request->input("maritalstatus");
        $person_info->phone = $request->input("phone");
        $person_info->city_id = 1;
        $person_info->governorate_id = 1;
		
		$person->person_status_id = 1;

		$money->amount = $request->input("amount");


		// Third Stage:
		// Saving Case object ..
		$person_info->save();
		$person->save();
		$money->save();

		return redirect()->route('money.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$money = Money::findOrFail($id);
		$money->delete();

		return redirect()->route('money.index')->with('message', 'Item deleted successfully.');
	}

}
