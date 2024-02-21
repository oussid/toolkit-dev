<?php 
namespace App\Search;

use Illuminate\Http\Request;

class Search {

    protected $allowedFields = ['status'];

    static function applySearch(Request $request, $eloquentInstance) {
        $searchQuery = $request->query('search');

        if(isset($searchQuery)){
            $eloquentInstance->with('Business')
            ->join('businesses', 'businesses.id', '=', 'projects.business_id')
            
            ->where('businesses.name', 'oisidsakid');
        }

        return $eloquentInstance;
    }
}
