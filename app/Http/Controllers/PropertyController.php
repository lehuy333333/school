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
    public function index($department_id)
    {
        $properties = Property::where('department_id', $department_id)->paginate(10);
        $department = Department::find($department_id);
        return view('properties.index',compact('properties', 'department'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($department_id)
    {
        $department = Department::find($department_id);
        return view('properties.create', compact('department'));
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
            'amount' => 'required',
        ]);
    
        Property::create($request->all());
    
        return redirect()->route('departments.properties.index', $request->department_id)
                        ->with('success','Property created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\property  $property
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property = Property::find($id);
        return view('properties.show',compact('property'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = Property::find($id);
        $departments = Department::pluck('name', 'id');
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
        $tmp_departmet = $property->department_id;
        request()->validate([
            'name' => 'required',
            'amount' => 'required',
            'inactive' => 'required',
            'department_id' => 'required',
        ]);
    
        $property->update($request->all());
    
        return redirect()->route('departments.properties.index', $tmp_departmet)
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