<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\models\Report;
use app\models\Category;
use Illuminate\Support\Facades\Auth;

class Reportcontroller extends Controller
{
    public function index() //отображение страницы мои заявки
    {
        $reports = Report::where('user_id', Auth::id()) //видно заявки только текущего пользователя
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('reports.index', compact('reports'));
    }

    public function create() //сформировать заявление
    {
        $categories = Category::all();
        return view('reports.create', compact('categories'));
    }

    public function store(Request $request) //сохранение заявления(нового)
    {
        $validated = $request->validate(['title' => 'required|string|max:255', 'category_id' => 'required|exists:categories,id', 'description' => 'required|string', 'date_incident' => 'required|date_format:d.m.Y', 'contact' => 'required|in:email,sms'], ['required' => 'Поле обязательно для заполнения.', 'date_incident.date.format' => 'Дата нужна в формате д.м.г', 'contact.in' => 'выбирете корректный способ связи',]);
        //добавление айди пользователя
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'new';

        Report::create($validated);

        return redirect()->route('reports.index');
    }
}
