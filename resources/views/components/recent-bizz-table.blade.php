<div class="table-container">    
    <table>
        <thead>
            <tr class="table-head">
                <th>
                    <div class="table-col head-col">
                        Name
                    </div>
                </th>
                <th>
                    <div class="table-col head-col">
                        Address
                    </div>
                </th>
                <th>
                    <div class="table-col head-col">
                        Number
                    </div>
                </th>
                <th>
                    <div class="table-col head-col">
                        Niche
                    </div>
                </th>
                <th>
                    <div class="table-col head-col">
                        Status
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
            @forelse ($businesses as $bizz)    
                <tr>
                    <td>
                        <div class="table-col body-col">
                            {{$bizz->name}}
                        </div>
                    </td>
                    <td>
                        <div class="table-col body-col">
                            {{$bizz->address}}
                        </div>
                    </td>
                    <td>
                        <div class="table-col body-col">
                            {{$bizz->number}}
                        </div>
                    </td>
                    <td>
                        <div class="table-col body-col">
                            {{$bizz->niche}}
                        </div>
                    </td>
                    <td>
                        <div class="table-col body-col">
                            @if ($bizz->is_contacted)
                                <p class="success">Contacted by {{$bizz->contacted_by == Auth::user()->id ? 'you': $bizz->contacter->name }}.</p>
                            @else
                                Not contacted yet.
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="table-col body-col btns-col">
                            <button class="table-details"><i class="fa-solid fa-list"></i></button>
                            {{-- {{dd($project)}} --}}
                            <a href=""><button class="table-edit"><i class="fa-solid fa-pen"></i></button></a>
                            <button class="table-delete"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
            @empty
            <tr>
                <td colspan="99" class="single-col">No businesses added today.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>