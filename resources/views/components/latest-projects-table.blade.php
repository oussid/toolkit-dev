
<div class="table-container">
    <table>
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
                        Price
                    </div>
                </th>
                <th>
                    <div class="table-col head-col">
                        Invoice total
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
            @forelse ($projects as $project)
            <tr>
                <td>
                    <div class="table-col body-col">
                        {{$project->business->name}}
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
                        {{$project->price ? "£".$project->price : 'Not Specified'}}
                    </div>
                </td>
                <td>
                    <div class="table-col body-col">
                        {{$project->invoice? "£".$project->invoice->total : 'Not Specified'}}
                    </div>
                </td>
                <td>
                    <div class="table-col body-col btns-col">
                        <button class="table-details"><i class="fa-solid fa-list"></i></button>
                        <a href="{{route('projects.edit', ['project'=>$project->id])}}"><button class="table-edit"><i class="fa-solid fa-pen"></i></button></a>
                        <button class="table-delete"><i class="fa-solid fa-trash"></i></button>
                        <a href="/invoices/create/{{ $project->id }}"><button><i class="fa-solid fa-file-invoice-dollar"></i></button></a>
                    </div>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="99" class="single-col">No projects found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
