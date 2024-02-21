
<div class="table-container">
    <table>
        @if ($props['type'] == 'projects')
            <thead>
                <tr class="table-head">
                    <th>
                        <div class="table-col head-col">
                            Business
                        </div>
                    </th>
                    <th>
                        <div class="table-col head-col">
                            Start Date
                        </div>
                    </th>
                    <th>
                        <div class="table-col head-col">
                            Finish date
                        </div>
                    </th>
                    <th>
                        <div class="table-col head-col">
                            Status
                        </div>
                    </th>
                    <th>
                        <div class="table-col head-col">
                            Invoice Total
                        </div>
                    </th>
                    <th>
                        <div class="table-col head-col ">
                            Actions
                        </div>
                    </th>
                </tr>
            </thead>

            <tbody>
                @forelse ($props['elements'] as $project)
                <tr>
                    <td>
                        <div class="table-col body-col">
                            <a class="light-gray underlined" href="{{route('businesses.show', ['business'=>$project->business->id])}}">{{$project->business->name}}</a>
                        </div>
                    </td>
                    <td>
                        <div class="table-col body-col">
                            {{$project->start_date}}
                        </div>
                    </td>
                    <td>
                        <div class="table-col body-col">
                            {{$project->finish_date ? $project->finish_date : 'Not Specified'}}
                        </div>
                    </td>
                    <td>
                        <div class="table-col body-col">
                            @if ($project->status == 'pending')
                            <p class="light-gray">Pending</p>
                            @elseif($project->status == 'ongoing')
                            <p class="primary">Ongoing</p>
                            @elseif($project->status == 'completed')
                            <p class="success">Completed</p>
                            @else
                            <p class="error">Canceled</p>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="table-col body-col">
                            @if ($project->invoice)
                                <p class="light-gray"> £{{$project->invoice->total }} </p>
                            @else
                                <a class="light-gray underlined" href="{{route('invoices.create', ['id'=>$project->id])}}">Add Invoice</a>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="table-col body-col btns-col">
                            <button class="table-details"><i class="fa-solid fa-list"></i></button>
                            <a href="{{route('projects.edit', ['project'=>$project->id])}}"><button class="table-edit"><i class="fa-solid fa-pen"></i></button></a>
                            <button class="table-delete"><i class="fa-solid fa-trash"></i></button>
                            @if ($project->invoice)
                                <a href="{{route('invoices.create', ['id'=>$project->id])}}"><button><i class="fa-solid fa-file-invoice-dollar"></i></button></a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="99" class="single-col">No projects found.</td>
                    </tr>
                @endforelse
            </tbody>

        @elseif($props['type'] == 'invoices')
            <thead>
                <tr class="table-head">
                    <th>
                        <div class="table-col head-col">
                            #
                        </div>
                    </th>
                    <th>
                        <div class="table-col head-col">
                            Project
                        </div>
                    </th>
                    <th>
                        <div class="table-col head-col">
                            Created At
                        </div>
                    </th>
                    <th>
                        <div class="table-col head-col">
                            Status
                        </div>
                    </th>
                    <th>
                        <div class="table-col head-col">
                            Additional Services
                        </div>
                    </th>
                    <th>
                        <div class="table-col head-col">
                            Total
                        </div>
                    </th>
                    <th>
                        <div class="table-col head-col ">
                            Actions
                        </div>
                    </th>
                </tr>
            </thead>

            <tbody>
                @forelse ($props['elements'] as $invoice)
                <tr>
                    <td>
                        <div class="table-col body-col">
                            {{$invoice->generated_id}}
                        </div>
                    </td>
                    <td>
                        <div class="table-col body-col">
                            <a class="light-gray underlined" href="{{route('businesses.show', ['business'=>$invoice->project->business->id])}}">
                                {{$invoice->project->business->name}}
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="table-col body-col">
                            {{$invoice->created_at}}
                        </div>
                    </td>
                    <td>
                        <div class="table-col body-col">
                            @if ($invoice->is_paid)
                                <p class="success">Paid</p>
                            @else
                                <p class="light-gray">Pending</p>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="table-col vertical">
                            @foreach (json_decode($invoice->services, true) as $service)
                                <p class="light-gray">-{{$service['name']}}: £{{$service['price']}}</p>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <div class="table-col body-col">
                            £{{$invoice->total}}
                        </div>
                    </td>
                    <td>
                        <div class="table-col body-col btns-col">
                            <a href="{{route('invoices.show', ['id'=>$invoice->id])}}"><button class="table-details"><i class="fa-solid fa-list"></i></button></a>
                            <a href="{{route('invoices.edit', ['id'=>$invoice->id])}}"><button class="table-edit"><i class="fa-solid fa-pen"></i></button></a>
                            <a href="{{route('invoices.destroy', ['id'=>$invoice->id])}}"><button class="table-delete"><i class="fa-solid fa-trash"></i></button></a>
                        </div>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="99" class="single-col">No invoices found.</td>
                    </tr>
                @endforelse
            </tbody>
        @endif
    </table>
        
</div>
