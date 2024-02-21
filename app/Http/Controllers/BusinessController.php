<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Filters\Business\BusinessFilter;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        // apply filter
        $filter = new BusinessFilter(); 
        $filterItems = $filter->transform($request);

        $businesses = Business::where($filterItems);

        // apply search
        $searchQuery = $request->query('search');
        // Check if there's a search query and filter conditions
    if (isset($searchQuery) && count($filterItems) > 0) {
        $businesses = Business::select('businesses.*', 'users.name as user_name')
            ->join('users', 'users.id', '=', 'businesses.user_id')
            ->where(function ($query) use ($searchQuery) {
                $query->where('businesses.name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('businesses.niche', 'like', '%' . $searchQuery . '%')
                    ->orWhere('businesses.address', 'like', '%' . $searchQuery . '%')
                    ->orWhere('businesses.website', 'like', '%' . $searchQuery . '%')
                    ->orWhere('businesses.number', 'like', '%' . $searchQuery . '%')
                    ->orWhere('businesses.email', 'like', '%' . $searchQuery . '%')
                    ->orWhere('businesses.rating', 'like', '%' . $searchQuery . '%')
                    ->orWhere('users.name', 'like', '%' . $searchQuery . '%');
            })
            ->where($filterItems);
    } elseif (isset($searchQuery)) {
        // Only apply search query
        $businesses = Business::select('businesses.*', 'users.name as user_name')
            ->join('users', 'users.id', '=', 'businesses.user_id')
            ->where(function ($query) use ($searchQuery) {
                $query->where('businesses.name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('businesses.niche', 'like', '%' . $searchQuery . '%')
                    ->orWhere('businesses.address', 'like', '%' . $searchQuery . '%')
                    ->orWhere('businesses.website', 'like', '%' . $searchQuery . '%')
                    ->orWhere('businesses.number', 'like', '%' . $searchQuery . '%')
                    ->orWhere('businesses.email', 'like', '%' . $searchQuery . '%')
                    ->orWhere('businesses.rating', 'like', '%' . $searchQuery . '%')
                    ->orWhere('users.name', 'like', '%' . $searchQuery . '%');
            });
    } elseif (count($filterItems) > 0) {
        // Only apply filter conditions
        $businesses = Business::where($filterItems);
    } else {
        // No search query or filter conditions, get all businesses
        $businesses = Business::query();
    }

        return view('businesses.index', [
            'businesses' => $businesses->orderby('created_at', 'desc')->paginate(9)->appends($request->query()),
            'users' => User::all(),
            'niches' => Business::pluck('niche')->unique(),
            'breadcrum' => [
                'tabs' => [
                    [
                        'url' => route('dashboard'),
                        'text' => 'DASHBOARD',
                        'isHome' => true,
                        'isActive' => false,
                    ],
                    [
                        'url' => route('businesses.index'),
                        'text' => 'BUSINESSES',
                        'isHome' => false,
                        'isActive' => true,
                    ],
                ], 
                'actionBtn' => [
                            'url' => route('businesses.create'),
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
        return view('businesses.create', [
            'breadcrum' => [
                'tabs' => [
                    [
                        'url' => route('dashboard'),
                        'text' => 'DASHBOARD',
                        'isHome' => true,
                        'isActive' => false,
                    ],
                    [
                        'url' => route('businesses.index'),
                        'text' => 'BUSINESSES',
                        'isHome' => false,
                        'isActive' => false,
                    ],
                    [
                        'url' => route('businesses.create'),
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
     * Show the form for bulk-creating a new resource.
     */
    public function bulkCreate()
    {
        return view('businesses.bulk-create', [
            'breadcrum' => [
                'tabs' => [
                    [
                        'url' => route('dashboard'),
                        'text' => 'DASHBOARD',
                        'isHome' => true,
                        'isActive' => false,
                    ],
                    [
                        'url' => route('businesses.index'),
                        'text' => 'BUSINESSES',
                        'isHome' => false,
                        'isActive' => false,
                    ],
                    [
                        'url' => route('businesses.bulk-create'),
                        'text' => 'BULK CREATE',
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
            'name'=> 'required',
            'address'=> 'required',
            'number'=> 'required|unique:businesses,number',
            'niche'=> 'required',
            'website'=>'nullable',
            'rating'=>'nullable|numeric|min:0.0',
            'email'=>'nullable|email',
            'notes' => 'nullable'
        ], [
            'number.unique' => 'Number used by another business.'
        ]);

        $fields['user_id'] = Auth::user()->id;

        Business::create($fields);

        return redirect()->back()->with('success', 'Business created successfully.');
    }

    /**
     * Store newly created resources in storage.
     */
    public function bulkStore(Request $request)
    {
        $data = $request->validate([
            'businesses' => 'required'
        ], [
            'businesses.required' => 'Please add at least 1 business'
        ]);

        $businesses = $this->removeEmptyElements(explode('|#|', $data['businesses']));
        $counter = 0;
        $notAdded = false;
        $notAddedNumbers = 'Numbers already exist: ';

        foreach($businesses as $business) {
            // name,address,number,niche,website

            $details = explode('|,|', $business);
            
            // check if number is unique
            $numExists = Business::where('number', $details[2])->first();
            if ($numExists) {
                $notAddedNumbers = $notAddedNumbers . $numExists->number . ', ';
                $notAdded = true;
                continue;
            }
            Business::create([
                'name'=> $details[0],
                'address'=> $details[1],
                'number'=> $details[2],
                'niche'=> $details[3],
                'website'=>empty($details[4]) ? null : $details[4],
                'notes'=>empty($details[5]) ? null : $details[5],
                'user_id'=> Auth::user()->id,
            ]);
            $counter++;
        }

        if($notAdded) {
            Session::flash('error', rtrim($notAddedNumbers, ', '));
        }

        if($counter>0) {
            return redirect()->back()->with('success', 'Created ' . $counter . ' businesses successfully!');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business)
    {
        return view('businesses.show', [
            'business'=> $business,
            'breadcrum' => [
                'tabs' => [
                    [
                        'url' => route('dashboard'),
                        'text' => 'DASHBOARD',
                        'isHome' => true,
                        'isActive' => false,
                    ],
                    [
                        'url' => route('businesses.index'),
                        'text' => 'BUSINESSES',
                        'isHome' => false,
                        'isActive' => false,
                    ],
                    [
                        'url' => route('businesses.show', ['business' => $business->id]),
                        'text' => strtoupper($business->name),
                        'isHome' => false,
                        'isActive' => true,
                    ],
                ], 
                'actionBtn' => null
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {

        return view('businesses.edit', [
            'business' => $business,
            'breadcrum' => [
                'tabs' => [
                    [
                        'url' => route('dashboard'),
                        'text' => 'DASHBOARD',
                        'isHome' => true,
                        'isActive' => false,
                    ],
                    [
                        'url' => route('businesses.index'),
                        'text' => 'BUSINESSES',
                        'isHome' => false,
                        'isActive' => false,
                    ],
                    [
                        'url' => route('businesses.show', ['business' => $business->id]),
                        'text' => strtoupper($business->name),
                        'isHome' => false,
                        'isActive' => false,
                    ],
                    [
                        'url' => route('businesses.edit', ['business' => $business->id]),
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
    public function update(Request $request, Business $business)
    {
        $fields = $request->validate([
            'name'=> 'required',
            'address'=> 'required',
            'number'=> Rule::unique('businesses')->ignore($business->id),
            'niche'=> 'required',
            'website'=>'nullable',
            'rating'=>'nullable|numeric|min:0.0',
            'email'=>'nullable|email',
            'status' => 'required|in:0,1,2,3',
            'notes'=>'nullable',
        ]);

        // business is contacted
        if($fields['status']==1 || $fields['status']==2) {
            $fields['contacted_by'] = Auth::user()->id;
            $fields['contacted_at'] = Carbon::now();
        }
        else {
            $fields['contacted_by'] = null;
            $fields['contacted_at'] = null;
            $fields['recontact_at'] = null;
        }


        $business->update($fields);

        return redirect()->back()->with('success', 'Business updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        $business->delete();
        return  redirect()->route('businesses.index')->with('success', 'Business successfully deleted.');
    }

    private function removeEmptyElements($array) {
        $filtered_array = array_filter($array, function($item) {
            return !empty($item);
        });

        return $filtered_array;
    }
}
