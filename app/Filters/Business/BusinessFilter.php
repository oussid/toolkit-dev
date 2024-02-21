<?php 

namespace App\Filters\Business;

use App\Filters\Filter;

class BusinessFilter extends Filter {
    protected $allowedFields = [
        'niche' => ['eq'],
        'user_id' => ['eq'],
        'status' =>  ['eq'],
        'contacted_by' =>  ['eq'],
    ];
}