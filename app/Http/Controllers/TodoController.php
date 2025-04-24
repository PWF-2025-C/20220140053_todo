<?php

namespace App\Http\Controllers;
use App\Models\Todo; // Pastikan model Todo diimpor
use Illuminate\Support\Facades\Auth; // Tambahkan ini untuk Auth
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(){
        //$todos = Todo::all();
        //$todos = Todo::where('user_id', Auth::id())->get();
        $todos = Todo::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        //dd($todos);
        return view('todo.index', compact('todos'));
    }

    public function create(){
        return view("todo.create");
    }

    public function edit(){
        return view("todo.edit");
    }

    public function store(request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $todo = Todo::create([
            'title' => ucfirst($request->title),
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('todo.index')->with('success', 'Todo created successfully.');
    }
}
