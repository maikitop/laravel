<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class AdminController extends Controller
{ // Страница администратора со списком всех заявок
    public function index(Request $request)
    {
        $query = Report::with(['user', 'category'])->orderBy('created_at', 'desc');

        // Фильтрация по статусу, если он передан
        if ($request->has('status') && in_array($request->status, ['new', 'resolved', 'rejected'])) {
            $query->where('status', $request->status);
        }

        // Пагинация (по 5 записей на страницу)
        $reports = $query->paginate(5);
        $reports->appends($request->except('page'));

        return view('admin.index', compact('reports'));
    }

    // Изменение статуса заявки
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:new,resolved,rejected'
        ]);

        $report = Report::findOrFail($id);
        $report->update(['status' => $request->status]);

        return back();
    }
}
