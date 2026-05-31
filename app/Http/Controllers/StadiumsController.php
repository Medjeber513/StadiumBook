<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Stadium;
use App\Models\User;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class StadiumsController extends Controller
{
    use AuthorizesRequests;
    // for players can see the list of stadium
    public function showStadiumsForPlayers()
    {
        $stadiums = Stadium::all();
        return view('Stadiums/stadiums_list', ['datas' => $stadiums]);
        // not created yet

    }
    public function show($id) {
        $datas =    Stadium::find($id);
        return view('Stadiums/stadium_show',['datas'=>$datas]);
    }
    public function create()
    {

    // }     ----------after make auth-----
        return view('Stadiums/stadium_create');
    }
    public function store(Request $request)
    {
        $user_id = Auth::id();
        $dataToInsert = [
            'owner_id'=>$user_id,
            'name' => $request->name,
            'location' => $request->location,
            'price' => $request->price,
            'maxPlayer' => $request->maxPlayer,
            'minPlayer' => $request->minPlayer,
            'openTime' => $request->openTime,
            'closeTime' => $request->closeTime,
            'created_at' => date('Y-m-d H:i:s')
        ];
        Stadium::create($dataToInsert);
        return redirect()->route('stadiums_index');
    }
    // lists of stadiums for the owner (same owner_id)
    public function index()
    {
        $owner_id = Auth::id();

        $stadiumsList =    Stadium::where("owner_id", $owner_id)->get();

        return view('Stadiums/stadiums_index', ['datas' => $stadiumsList]);
    }
    public function edit($id) {
        $datas = Stadium::findOrfail($id);
        $this->authorize('edit',$datas);
return view('Stadiums/stadium_edit',['datas'=>$datas]);
    }

    public function update(Request $request,$id) {

        $dataToUpdate = Stadium::findOrFail($id);
        $this->authorize('update',$dataToUpdate);

        $dataToUpdate -> name = $request -> name;
        $dataToUpdate -> location = $request -> location;
        $dataToUpdate -> price = $request -> price;
        $dataToUpdate -> maxPlayer = $request -> maxPlayer;
        $dataToUpdate -> minPlayer = $request -> minPlayer ;
        $dataToUpdate -> openTime = $request -> openTime;
        $dataToUpdate -> closeTime = $request -> closeTime;
        $dataToUpdate->Save();
        return redirect()->route('stadiums_index');
        }
    public function destroy($id) {
        $stadiumToDelete=Stadium::find($id);
        $stadiumToDelete -> delete();
        return redirect()->route('stadiums_index');
    }

}
