<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Note;
use App\User;
use Storage;
use Zipper;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //list of notes
        $notes = Note::get();
        //var_dump($notes);
        return view('home',['notes'=>$notes, 'no'=>1]);
    }

    public function contributor()
    {
        $contributors = User::get();
        //var_dump($notes);
        return view('contributor',['contributors'=>$contributors, 'no'=>1]);
    }

    public function list_note_by_contributor($id_contributor)
    {
        //list notes by contributor
        $notes = Note::select('notes.id','notes.note_title','notes.description','notes.owner','notes.content')
                ->leftjoin('users_to_notes','notes.id','=','users_to_notes.id_note')
                ->where('users_to_notes.id_user','=',$id_contributor)
                ->get();
        $contributor = User::where('id','=',$id_contributor)->get();
        return view('home',['notes'=>$notes,'contributor'=>$contributor,'no'=>1]);
    }

    public function view($id_note)
    {
        
        $note = Note::where('id','=',$id_note)->get();
        $filename = $note[0]->note_title.'.html';
        $dir = $note[0]->note_title;
        $this->createNoteContent($id_note);
        $contents = Storage::get('public/'.$dir.'/'.$filename);

        //$path = Storage::url($filename);
        echo $contents;
        //return response()->download('storage/app/public/'.$dir.'.zip');
        //return view('view',['note'=>$note,'file'=>$path]);
    }

    private function createNoteContent($id_note){
        $note = Note::where('id','=',$id_note)->get();
        $filename = $note[0]->note_title.'.html';
        $dir = $note[0]->note_title;
        //create directory
        Storage::makeDirectory($dir); //create directory
        //create html content 
        Storage::disk('public')->put($dir.'/'.$filename, $note[0]->content); //create html content
        //create txt content [id note, id user]
        $conf = $note[0]->id.":".$note[0]->note_title.":".$note[0]->owner;
        Storage::disk('public')->put($dir.'/'.$dir, $conf);
        
        //get files under note dir
        $files = glob('storage/app/public/'.$dir.'/*');
        //archive the files
        Zipper::make('storage/app/public/'.$dir.'.zip')->add($files);
    }

    /**
     * Find the note by specified keyword
     *
     * @param  int  $id note
     * @return \Illuminate\Http\Response
     */
    public function find_note(Request $request)
    {
        $keyword = $request->input('keyword');
        $notes = Note::where('note_title','like','%'.$keyword.'%')->get();
        return view('home',['notes'=>$notes, 'no'=>1,'keyword'=>$keyword]);

    }

    public function download($id_note)
    {
        $note = Note::where('id','=',$id_note)->get();
        $dir = $note[0]->note_title;
        $exists = Storage::disk('public')->exists($dir.'.zip');
        
        $this->createNoteContent($id_note);
        
        return response()->download('storage/app/public/'.$dir.'.zip');
    }
}
