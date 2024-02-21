<?php

namespace App\Http\Controllers;


use App\Search\Search;
use App\Models\Project;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Filters\Project\ProjectFilter;

class ProjectController extends Controller
{

    private function removeEmptyElements($array) {
        $filtered_array = array_filter($array, function($item) {
            return !empty($item);
        });

        return $filtered_array;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //  apply filters
        $filter = new ProjectFilter(); 
        $filterItems = $filter->transform($request);
        $projects = Project::where($filterItems);
        
        // apply search
        $searchQuery = $request->query('search');
        if(isset($searchQuery)){
            $projects->select('projects.*', 'businesses.id as business_id')
                    ->join('businesses', 'businesses.id', '=', 'projects.business_id')
                    ->where('projects.status', 'like', '%'.$searchQuery.'%')
                    ->orWhere('projects.start_date', 'like', '%'.$searchQuery.'%')
                    ->orWhere('projects.finish_date', 'like', '%'.$searchQuery.'%')
                    ->orWhere('projects.notes', 'like', '%'.$searchQuery.'%')
                    ->orWhere('projects.objectives', 'like', '%'.$searchQuery.'%')
                    ->orWhere('projects.price', 'like', '%'.$searchQuery.'%')
                    ->orWhere('projects.total_paid', 'like', '%'.$searchQuery.'%')
                    ->orWhere('businesses.name', 'like', '%'.$searchQuery.'%')
                    ->orWhere('businesses.name', 'like', '%'.$searchQuery.'%');
        }

        return view('projects.index', [
            'tableProps' => [
                'type' => 'projects',
                'elements' =>  Project::get()
             ],
            'breadcrum' => [
                'tabs' => [
                    [
                        'url' => route('dashboard'),
                        'text' => 'DASHBOARD',
                        'isHome' => true,
                        'isActive' => false,
                    ],
                    [
                        'url' => route('projects.index'),
                        'text' => 'PROJECTS',
                        'isHome' => false,
                        'isActive' => true,
                    ],
                ], 
                'actionBtn' => [
                    'url' => route('projects.create'),
                    'text' => 'ADD NEW',
                ]
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $businesses = Business::all();

        return view('projects.create', [
            'businesses' => $businesses,
            'breadcrum' => [
                'tabs' => [
                    [
                        'url' => route('dashboard'),
                        'text' => 'DASHBOARD',
                        'isHome' => true,
                        'isActive' => false,
                    ],
                    [
                        'url' => route('projects.index'),
                        'text' => 'PROJECTS',
                        'isHome' => false,
                        'isActive' => false,
                    ],
                    [
                        'url' => route('projects.create'),
                        'text' => 'ADD NEW',
                        'isHome' => false,
                        'isActive' => true,
                    ],
                ], 
                'actionBtn' => null
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'start_date' => 'required|date',
            'finish_date' => 'nullable|date|after:start_date',
            'business_id' => 'required',
            'status' => 'required|in:pending,ongoing,completed,canceled',
            'objectives' => 'required',
            'notes' => 'nullable',
        ]);
        
        $fields['objectives'] = json_encode($this->removeEmptyElements(explode('|#|', $request->objectives))) ;

        Project::create($fields);
        return redirect()->back()->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $businesses = Business::all();

        $objString = '';
        // transform objectives to a readable string
        foreach (json_decode($project->objectives) as $objective) {
            $objString = $objString . $objective . '|#|';
        }
        $project->objectives = $objString;
        
        return view('projects.edit', [
            'project'=> $project, 'businesses' => $businesses,
            'breadcrum' => [
                'tabs' => [
                    [
                        'url' => route('dashboard'),
                        'text' => 'DASHBOARD',
                        'isHome' => true,
                        'isActive' => false,
                    ],
                    [
                        'url' => route('projects.index'),
                        'text' => 'PROJECTS',
                        'isHome' => false,
                        'isActive' => false,
                    ],
                    [
                        'url' => "#",
                        'text' => strtoupper($project->business->name) . "'S PROJECT",
                        'isHome' => false,
                        'isActive' => false,
                    ],
                    [
                        'url' => route('projects.edit', ['project' => $project->id]),
                        'text' => 'EDIT',
                        'isHome' => false,
                        'isActive' => true,
                    ],
                ], 
                'actionBtn' => null
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $fields = $request->validate([
            'start_date' => 'required|date',
            'finish_date' => 'nullable|date|after:start_date',
            // 'price' => 'required|numeric|min:0.00',
            // 'total_paid' => 'nullable|numeric|min:0.00',
            'business_id' => 'required',
            'status' => 'required|in:pending,ongoing,completed,canceled',
            'objectives' => 'required',
            'notes' => 'nullable',
        ]);

        $fields['objectives'] = json_encode($this->removeEmptyElements(explode('|#|', $request->objectives))) ;

        $project->update($fields);

        return redirect()->back()->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->back()->with('success', 'Project deleted successfully.');
    }
}
