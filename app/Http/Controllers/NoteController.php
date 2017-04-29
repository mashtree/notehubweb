<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Note;
use App\User;
use App\UserToNote;
use Auth;

use DB;

class NoteController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the notes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //show all notes
        $notes = Note::where('owner','=',Auth::id())->get();
        $contributor = User::where('id','=',Auth::id())->get();
        return view('note.mngView',['notes'=>$notes,'no'=>1]);

    }


    public function update($id_note, Request $request)
    {
        if ($request->isMethod('post')) {
            $desc = $request->input('description');
            $institution = $request->input('institution');
            $address = $request->input('address');
            $note = Note::find($id_note);
            $note->description = $desc;
            $note->institution = $institution;
            $note->institution_address = $address;
            $note->save();
            return redirect()->route('note');
        }else{
            $note = Note::where('id','=',$id_note)->first();
            return view('note.update',['note'=>$note]);
        }
        
    }

    public function contributor($id_note){
        $note = Note::where('id','=',$id_note)->first();
        $contributors = DB::table('users')
            ->join('users_to_notes', 'users.id', '=', 'users_to_notes.id_user')
            ->select('users.*','users_to_notes.id as id_user_to_note', 'users_to_notes.role as role')
            ->where('users_to_notes.id_note','=',$id_note)
            ->get();
        return view('note.contributor',['note'=>$note,'contributors'=>$contributors,'no'=>1]);
    }

    /**
     * POST : add a contributor to the note
     *
     * @param  int  $id note
     * @return \Illuminate\Http\Response
     */
    public function update_contributor($id_contributor, $id_note)
    {
        $users_to_notes = new UserToNote();
        $users_to_notes->id_user = $id_contributor;
        $users_to_notes->id_note = $id_note;
        $users_to_notes->role = 2;
        $users_to_notes->save();
        return redirect()->route('contributor',['id_note'=>$id_note]);
    }

    /**
     * Find the contributor and display them on edit_contributor function
     *
     * @param  int  $id note
     * @return \Illuminate\Http\Response
     */
    public function find_contributor(Request $request)
    {
        $note = Note::where('id','=',$request->input('id_note'))->first();
        $contributors = DB::table('users')
                ->where('name', 'like', '%'.$request->input('keyword').'%')
                ->get();
        return view('note.contributor_find',['note'=>$note,'contributors'=>$contributors,'no'=>1]);
    }

    /**
     * Remove the specified note  from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Note::destroy($id);
        return redirect()->route('note');
    }

    public function deletec($id_user_to_note){
        $user_to_note = UserToNote::find($id_user_to_note);
        UserToNote::destroy($id_user_to_note);
        return redirect()->route('contributor',['id_note'=>$user_to_note->id_note]);
    }
}
