<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\models\Report;
use app\models\Category;
use Illuminate\Support\Facades\Auth;

class Reportcontroller extends Controller
{
    public function index()
    {
        $reports = Report::where('user_id', Auth::id())
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('reports.create', compact('categories'));
    }
}
