<?php
    
namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Property;
use Illuminate\Http\Request;
    
class PropertyController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:property-list|property-create|property-edit|property-delete', ['only' => ['index','show']]);
         $this->middleware('permission:property-create', ['only' => ['create','store']]);
         $this->middleware('permission:property-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:property-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::paginate(10);
        return view('properties.index',compact('properties'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::pluck('name', 'id')->all();
        return view('properties.create', compact('departments'));
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
    
        Property::create($request->all());
    
        return redirect()->route('properties.index')
                        ->with('success','Property created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        return view('properties.show',compact('property'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        $departments = Department::pluck('name', 'id')->all();
        return view('properties.edit',compact('property', 'departments'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
         request()->validate([
            'name' => 'required',
        ]);
    
        $property->update($request->all());
    
        return redirect()->route('properties.index')
                        ->with('success','Property updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $property->delete();
    
        return redirect()->route('properties.index')
                        ->with('success','Property deleted successfully');
    }
}