<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
        // SHOW DASHBOARD
        public function dashboard(Request $request)
        {
            $revYear = $request->query('rev_year');
            $today = Carbon::today();

            $businessesByStatus = $this->businessesByIsContacted();
            $projectsByStatus = $this->projectsByStatus();
            $bizzByUser = $this->businessesByUser();
            $revenue = $this->monthlyRevenue($revYear)['monthlyRevenue'];
            $years = $this->getInvoicesYears();
            $addedBizzChart = $this->dailyBizz();
            $contactedBizzChart = $this->dailyBizz(1);
            $contactedPercentage = $this->yesterdayVsTodayBizz(1);
            $addedPercentage = $this->yesterdayVsTodayBizz();
            
            return view('index', [
                'businessesByStatus' => $businessesByStatus,
                'projectsByStatus' => $projectsByStatus,
                'bizzByUser' => $bizzByUser,
                'revenue' => $revenue,
                'years' => $years,
                'addedBizzChart' => $addedBizzChart,
                'contactedBizzChart' => $contactedBizzChart,
                'addedPercentage' => $addedPercentage,
                'contactedPercentage' => $contactedPercentage,
                'recentBizz' => Business::whereDate('created_at', $today)->latest('created_at')->take(5)->get(),
                'projectsTableProps' => [
                    'type' => 'projects',
                    'elements' =>  Project::latest('created_at')->take(5)->get()
                 ],
                'totals' => [
                    'businesses' => Business::count(),
                    'projects' => Project::count(),
                    'users' => User::count(),
                    'revenue' => $this->monthlyRevenue($revYear)['total'],
                ]
            ]);
        }

        // ASSOC ARRAY OF REVENUES BY MONTH
        public function monthlyRevenue ($year=null) {

            if(!$year || ($year && $year==date('Y'))) {
                $year = date('Y');
                $endMonth = date('n');
                $endDay = date('j');
            } else {
                $endMonth = 12;
                $endDay = 31;
            }
            // setting the start and end of the year
            $startOfYear = "{$year}-01-01 00:00:00";
            $endOfYear = $year . '-' . $endMonth . "-".$endDay." 23:59:59";

            // getting all invoices of the year
            $invoices = Invoice::whereBetween('created_at', [$startOfYear, $endOfYear])
                        ->with('project')
                        ->where('is_paid', 1)
                        ->get();

            // create an array of monthly revenue (0 for each month)
            $monthlyRevenue;
            for($month=1; $month<= $endMonth; $month++) {
                $monthlyRevenue[$month] = 0;
            }

            // fill array
            foreach ($invoices as $invoice) {
                $month = $invoice->created_at->format('n');
                $price = $invoice->total;

                $monthlyRevenue[$month] += $price;
            }

            // convert the month numbers to month names
            $revenueByMonthWithNames = [];
            foreach ($monthlyRevenue as $monthNum => $revenue) {
                $date = Carbon::createFromDate($year, $monthNum, 1);
                $monthName = $date->format('F');
                $revenueByMonthWithNames[$monthName] = $revenue;
            }

            // dd($revenueByMonthWithNames);


            return [
                'monthlyRevenue' => $revenueByMonthWithNames,
                'total' => $invoices->sum('total')
            ];
        }

        // TOTAL REVENUE BASED ON PAID INVOICES
        public function totalRevenue ($year=null) {
            if(!$year || ($year && $year=date('Y'))) {
                $year = date('Y');
                $endMonth = date('t');
            } else {
                $endMonth = 12;
            }
            // setting the start and end of the year
            $startOfYear = "{$year}-01-01 00:00:00";
            $endOfYear = $year . '-' . $endMonth. '-' . date('d') . " 23:59:59";

            $total = Invoice::whereBetween('created_at', [$startOfYear, $endOfYear])
                        ->where('is_paid', 1)
                        ->get();
        }

        // ASSOC ARRAY OF BUSINESSES DISTRIBUTION BY STATUS (CONTACTED, NOT CONTACTED)
        public function businessesByIsContacted () {
            
            return [
                'contacted' => Business::where('contacted_at', '<>', null)->count(),
                'notContacted' => Business::where('contacted_at', '=', null)->count(),
            ];

        }

        // ASSOC ARRAY OF PROJECT DISTRIBUTION BY STATUS (PENDING, ONGOING, COMPLETED, CANCELED)
        public function projectsByStatus () {
            $projects = DB::table('projects')
                        ->select('status', DB::raw('COUNT(*) as count'))
                        ->groupBy('status')
                        ->pluck('count', 'status')
                        ->toArray();

            return [
                'pending' => $projects['pending'] ?? 0,
                'ongoing' => $projects['ongoing'] ?? 0,
                'completed' => $projects['completed'] ?? 0,
                'canceled' => $projects['canceled'] ?? 0,
            ];;
        }

        // ASSOC ARRAY OF TOTAL BUSINESSES ADDED BY USER (today)
        public function businessesByUser() {
            $today = Carbon::today();
            $businessCounts = Business::whereDate('businesses.created_at', $today)
                ->leftJoin('users', 'businesses.user_id', '=', 'users.id')
                ->select('users.name', Business::raw('count(*) as count'))
                ->groupBy('users.name')
                ->get();

            // Transform the collection to key-value pairs ['name' => count]
            $businessCountsByUserToday = $businessCounts->pluck('count', 'name')->toArray();

            return $businessCountsByUserToday;
        }

        // ARRAY OF DISTINCT INVOICES YEARS (USED IN REVENUE CHART)
        public function getInvoicesYears () {
            $uniqueYears = Invoice::distinct()
                ->selectRaw('YEAR(created_at) as year')
                ->pluck('year')
                ->toArray();

            return count($uniqueYears)>0 ? $uniqueYears : [date('Y')] ;
        }

        // ASSOC ARRAY OF DAILY ADDED BUSINESSES
        public function dailyBizz ($isContacted=null) {
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;

            $days = [];
            for ($i=1; $i <= date('j') ; $i++) {
                $days[$i] = 0;
            }
            
            
            if($isContacted) {
                // based on contact date
                $businesses = Business::selectRaw('DATE(contacted_at) as date, COUNT(*) as count')
                ->whereRaw("MONTH(contacted_at) = $currentMonth AND YEAR(contacted_at) = $currentYear")
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();
            }else {
                // based on creation date
                $businesses = Business::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->whereRaw("MONTH(created_at) = $currentMonth AND YEAR(created_at) = $currentYear")
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();
            }
            
            foreach ($businesses as $business) {
                $dayNumber = date('j', strtotime($business->date));
                $days[$dayNumber] = $business->count;
            }
            
            return $days;
        }

        // THE DIFFERENCE BETWEEN YESTEDAY'S ADDED/CONTACTED BUSINESSES AND TODAY'S
        public function yesterdayVsTodayBizz($isContacted=null) {
            $today = Carbon::today()->toDateString();
            $yesterday = Carbon::yesterday()->toDateString();

            $todaysCount = Business::whereDate('created_at', $today);
            $yesterdaysCount = Business::whereDate('created_at', $yesterday);

            if($isContacted) {
                $todaysCount = Business::whereDate('contacted_at', $today);
                $yesterdaysCount = Business::whereDate('contacted_at', $yesterday);
            }

            $todaysCount = $todaysCount->count();
            $yesterdaysCount = $yesterdaysCount->count();

            $difference = $todaysCount - $yesterdaysCount;
            $percentageDifference = ($difference / max(abs($yesterdaysCount), 1)) * 100;

            return $percentageDifference;
        }

        // FORMATS THE NUMBER WITH 2 DECIMAL PLACES & REMOVES TRAILING ZEROS AND DECIMAL POINT FOR INTEGERS
        public function formatNumber($number) {
            $formattedNumber = number_format($number, 2);
            return rtrim(rtrim($formattedNumber, '0'), '.');
        }
}
