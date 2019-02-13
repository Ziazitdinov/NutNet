<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class RecordController extends Controller
{
    public function records(){
      $records = DB::table('records')->orderBy('id', 'desc')->paginate(3);
    	return view('record.records', ['records' => $records]);
  	}

    public function recordCreate(){
      return view('record.create');
    }

    public function create(Request $request){
      DB::table('records')->insert(['name' => $request->name,
                                    'group' => $request->group,
                                    'genre' => $request->genre,
                                    'title' => $request->title]);
      return redirect('records');
    }

  	public function edit($id){
      $url = url()->previous();
      $session = Session::put('url', $url);
    	return view('record.edit', ['record' => Record::findOrFail($id)]);
  	}

    public function update(Request $request, $id){
      $redirect =  Session::get('url');
      $record = Record::findOrFail($id);
      DB::table('records')->where('id', $record->id)->update(['name' => $request->name,
                                                              'group' => $request->group,
                                                              'genre' => $request->genre,
                                                              'title' => $request->title]);
      return redirect($redirect);
    }

  	public function delete($id){
	    $record = Record::findOrFail($id);
	    DB::table('records')->where('id', $record->id)->delete();
	    return redirect('records')->with('status', 'Песня удалена');
  	}

   /*	public function delete($id) {
      DB::delete('delete from records where id = ?',[$id]);
      echo "Record deleted successfully.<br/>";
      echo '<a href="records/delete/{record}">Click Here</a> to go back.';
    }*/

}