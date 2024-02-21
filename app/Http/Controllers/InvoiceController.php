<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function index(){
        $invoices = Invoice::all();

       return view(
        'invoices.index',
        [
            'tableProps' => [
               'type' => 'invoices',
               'elements' =>  $invoices
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
                        'text' => 'INVOICES',
                        'isHome' => false,
                        'isActive' => true,
                    ],
            ], 
            'actionBtn' => [
                'url' => route('invoices.create'),
                'text' => 'ADD NEW',
            ]
        ]
        ]
    );
    }
    
    public function create($project_id=null){
        if(count(Invoice::where("project_id","=",$project_id)->get())>=1 && $project_id){
            $invoice = Invoice::where("project_id","=",$project_id)->first();

            return redirect("/invoices/".$invoice->id);
        }
        else{
            $project = $project_id ? Project::find($project_id) : null;
            $projects = Project::doesntHave('invoice')->get();
            return view("invoices.create",[
                "project"=>$project,
                "projects"=>$projects,
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
                            'text' => 'INVOICES',
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
    }

    public function show($id){
        $invoice = Invoice::findOrFail($id);
        return view("invoices.show", [
            "invoice"=>$invoice,
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
                        'text' => 'INVOICES',
                        'isHome' => false,
                        'isActive' => false,
                    ],
                    [
                        'url' => route('projects.create'),
                        'text' => $invoice->project ? $invoice->project->business->name : 'ADD NEW',
                        'isHome' => false,
                        'isActive' => true,
                    ],
                ], 
                'actionBtn' => null
            ]
        ]);
    }
    
    public function store(Request $req){
        $req->validate([
            'project_id' => 'required|integer',
            'services_input' => 'required',
        ]);

        $segments = explode(",", $req->services_input);
        $result = [];
        $project = Project::find($req->project_id);
        $total = $project->price;
        // Generate a random string with mixed characters
        $generatedId = Str::random(10); 
        
        // Loop through the segments array and organize them into key-value pairs
        for ($i = 0; $i < count($segments); $i += 3) {
            // Check if there are enough elements in the array for a key-value pair
            if (isset($segments[$i + 1])) {
                // Extract the name and price values
                $name = $segments[$i];

                $price = $segments[$i + 1]; // Convert the price to an integer
                if($price!="FREE"){
                    $total +=(int)$price;
                }

                $quantity = $segments[$i + 2];
                // Create a new associative array and add it to the result array
                $result[] = ["name" => $name, "price" => $price, "quantity"=> $quantity];
                
            }
        }
        
        Invoice::create([
            "user_id"=>Auth::user()->id,
            "project_id"=> $req->project_id,
            "services"=>json_encode($result),
            "total"=>$total,
            "is_paid"=>$req->isPaid=="on"?true:false,
            "generated_id" => '#'.$generatedId
        ]);
        return redirect()->back()->with("success", "Invoice created successfully");
    }

    public function edit($id){
        $invoice = Invoice::find($id);
        $projects = Project::all();
        return view("invoices.edit",["invoice"=>$invoice,"projects"=>$projects]);
    }

    public function update(Request $req, $id){
        $segments = explode(",", $req->services_input);
        $result = [];
        $project = Project::find($req->project_id);
        $total = $project->price;

        // Step 3: Loop through the segments array and organize them into key-value pairs
        for ($i = 0; $i < count($segments); $i += 2) {
            // Check if there are enough elements in the array for a key-value pair
            if (isset($segments[$i + 1])) {
                // Extract the name and price values
                $name = $segments[$i];

                $price = $segments[$i + 1]; // Convert the price to an integer
                if($price!="FREE"){
                    $total +=(int)$price;
                }
                // Create a new associative array and add it to the result array
                $result[] = ["name" => $name, "price" => $price];
            }
        }
        $invoice = Invoice::find($id);
        $invoice->project_id = $req->project_id;
        $invoice->total = $total;
        $invoice->services = json_encode($result);
        $invoice->is_paid = $req->isPaid=="on"?true:false;
        $invoice->save();
        return redirect("/invoices/".$invoice->id)->with("success","Invoice updated successfuly");
    }

    public function markAs($id,$newValue){
        $invoice = Invoice::find($id);
        $invoice->is_paid = $newValue=="on"?true:false;
        $invoice->save();
        return redirect("/invoices/".$invoice->id)->with("success","Invoice updated successfuly");
    }

    public function destroy($id){

        Invoice::destroy($id);
        return redirect("/projects")->with("success","Invoice deleted successfuly");
    }
}
