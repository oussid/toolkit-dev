@extends('layouts.main')

@section('content')
<div class="dashboard">
    <div class="dashboard-cards">
        <x-revenue-chart-card :revenue="$revenue" :years="$years" :total="$totals['revenue']"/>
        
        <div class="dashboard-card">
            <div class="card-section left">
                <p class="bg-title">Total Businesses</p>
            </div>
            <div class="card-section">
                <h2 class="card-counter">{{$totals['businesses']}}  business{{$totals['businesses'] > 1 ? 'es' : ''}}</h2>
            </div>
            @if ($totals['businesses'] == 0)
                    <x-empty-doughnut />
                
            @else
                <div class="card-section ">
                    <x-bizz-status-chart :businessesByStatus="$businessesByStatus"/>
                </div>
            @endif
        </div>
        <div class="dashboard-card">
            <div class="card-section left">
                <p class="bg-title">Total Projects</p>
            </div>
            <div class="card-section">
                <h2 class="card-counter">{{$totals['projects']}} project{{$totals['projects'] > 1 ? 's' : ''}}</h2>
            </div>
            @if ($totals['projects'] == 0)
            <x-empty-doughnut />
            @else
            <div class="card-section ">
                    <x-projects-by-status :projectsByStatus="$projectsByStatus"/>
                </div>
            @endif
        </div>
        <div class="dashboard-card">
            <div class="card-section left">
                <p class="bg-title">User Activity</p>
            </div>
            <div class="card-section">
                <h2 class="card-counter">{{$totals['users']}} user{{$totals['users'] > 1 ? 's' : ''}}</h2>
            </div>
            @if (count($bizzByUser) == 0)
                    <x-empty-doughnut />
            @else
                <div class="card-section ">
                    <x-bizz-by-user-chart :bizzByUser="$bizzByUser"/>
                </div>
            @endif
        </div>
        
    </div>

     <div class="section">
        <div class="section-row">
            <h2>Recent Businesses</h2>
            <a href="{{route('businesses.index')}}"><button>VIEW ALL</button></a> 
        </div>
        <div class="section-row">
            <x-recent-bizz-table :businesses="$recentBizz" />
        </div>
    </div>

    <div class="section">
        <div class="section-row">
            <h2>Daily Performance</h2>
        </div>

        <div class="section-row">
            <div class="percentage-cards-container">
                <x-added-bizz-percentage :addedBizzChart="$addedBizzChart"  :addedPercentage="$addedPercentage"/>
                <x-contacted-bizz-percentage :contactedBizzChart="$contactedBizzChart" :contactedPercentage="$contactedPercentage"/>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-row">
            <h2>Latest Projects</h2>
            <a href="{{route('projects.index')}}"><button>VIEW ALL</button></a> 
        </div>
        <div class="section-row">
            <x-table :props="$projectsTableProps" />
        </div>
    </div>
</div>


@endsection