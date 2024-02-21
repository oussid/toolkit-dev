<?php 

namespace App\Filters\Project;

use App\Filters\Filter;

class ProjectFilter extends Filter {
    protected $allowedFields = [
        'business_id' => ['eq'],
        'start_date' => ['eq'],
        'finish_date' =>  ['eq'],
        'status' =>  ['eq'],
        'notes' =>  ['eq'],
        'objectives' =>  ['eq'],
        'price' =>  ['eq'],
    ];
}