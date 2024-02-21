<?php 

namespace App\Filters;
use Illuminate\Http\Request;


class Filter {
    protected $allowedFields = [];

    protected $operatorsMap = [
        'gt'=> '>',
        'gte'=> '>=',
        'lt'=> '<',
        'lte'=> '<=',
        'eq'=> '=',
    ];

    public function isAssociativeArray($array) {
        $keys = array_keys($array);
        return array_keys($keys) !== $keys;
    }

    public function transform (Request $request) {
        $eloQuery = []; // [ [column, operator, value], ... ]
        foreach($this->allowedFields as $field => $operators){
            // get the query for a specific field
            $query = $request->query($field);
            // check if the field exist in the query
            if(!isset($query)) {
                continue;
            }
            // column found
            $column = $field;

            // if the query is an array that means that operators has been passed to the query
            if(is_array($query)) {
                foreach ($operators as $operator) {
                    if(isset($query[$operator])){
                        // value found
                        $val = $query[$operator];
                        // operator found. tranform it to an sql readable operator
                        $op = $this->operatorsMap[$operator];
                        // genrate an array that can be used inside eloquent's where clause, and append it to $eloQuery
                        $eloQuery[] = [$column, $op, $val];
                    }
                }
            }
            // no operators passed, we only need [column, value]
            else {
                $eloQuery[] = [$column, $query]; // the query in this case is the value
            }
        }

        return $eloQuery;
    }
}