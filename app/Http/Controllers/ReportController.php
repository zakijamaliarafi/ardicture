<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::with(['user', 'post'])->get();
        return view('reports.index', [
            'reports' => $reports,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function action(Request $request)
    {
        $validated_data = $request->validate([
            'post_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($request->report_id == 0) {
            $report = Report::create([
                'post_id' => $validated_data['post_id'],
                'user_id' => $validated_data['user_id'],
            ]);
            return response()->json(['success' => true, 'report_id' => $report->id, 'message' => 'Report Submitted']);
        } else {
            Report::where('id', $request->report_id)->delete();
            return response()->json(['success' => true, 'report_id' => 0, 'message' => 'Report Deleted']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $report = Report::where('id', $id)->first();
        $report->delete();
        if (auth()->user->role == 'admin') {
            return redirect()->route('reports.index');
        } else {
            return response()->json();
        }
    }
}
