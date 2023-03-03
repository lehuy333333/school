<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Department;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:borrowing-list|borrowing-create|borrowing-edit|borrowing-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:borrowing-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:borrowing-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrowing-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrowings = Borrowing::paginate(5);
        return view('borrowings.index', compact('borrowings'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $date_pick = $request->date_pick;
        $departments = Department::pluck('name', 'id')->all();
        return view('borrowings.create', compact('date_pick', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
        ]);

        Borrowing::create($request->all());

        return redirect()->route('borrowings.index')
            ->with('success', 'borrowing created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function show(Borrowing $borrowing)
    {
        return view('borrowings.show', compact('borrowing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function edit(Borrowing $borrowing)
    {
        return view('borrowings.edit', compact('borrowing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Borrowing $borrowing)
    {
        request()->validate([
            'name' => 'required',
        ]);

        $borrowing->update($request->all());

        return redirect()->route('borrowings.index')
            ->with('success', 'borrowing updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Borrowing $borrowing)
    {
        $borrowing->delete();

        return redirect()->route('borrowings.index')
            ->with('success', 'borrowing deleted successfully');
    }
}
