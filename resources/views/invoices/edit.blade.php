@extends('layouts.main')
@section('content')
    <div class="main">
        <div class="form-container" style="width: 40%">
            <form action="{{route('invoices.update',["id"=>$invoice->id])}}" method="POST" class="form-section" >
                @csrf
                <div class="section-row">
                    <h2 class="subtitle">Edit Invoice</h2>
                </div>
                           {{-- OBJECTIVES --}}
            <div class="section-row">
                <div class="section-col">
                    <input type="text" name="services_input" id="services_input" hidden>
                    <p class="form-error" id="nameErrorField"></p>
                    <div class="section-row row">
                        <input  class="field" id="serviceName" type="text" placeholder="Service name">
                        <input  class="field" id="servicePrice" type="number" placeholder="Service price">
                        <button  onclick="addService()">ADD</button>
                        <script>
                            function updateService(){
                                let servicesInput = document.querySelector("#services_input")
                                let sevicesPoolItems = document.querySelectorAll(".dashed-area-item")
                                let services = []
                                sevicesPoolItems.forEach(element => {
                                    price = element.children.item(2).innerText;
                                    services.push([element.children.item(1).innerText, price=="FREE"? "FREE" : Number(price.slice(1)) ])
                                });
                                servicesInput.value = services
                            }
                            function addService(){
                                event.preventDefault()
                                let serviceName = document.querySelector("#serviceName").value
                                let servicePrice = document.querySelector("#servicePrice").value == ""?"Free":document.querySelector("#servicePrice").value
                                let servicePool = document.querySelector("#servicesArea");
                                newService = document.createElement("div");
                                newService.className = "dashed-area-item"
                                newService.style = "max-width: calc(456px - 1rem);"
                                newService.innerHTML = `<span class="hashtag">#</span><span class="serviceName">${serviceName}</span> - <span class="sevicePrice">${servicePrice=="Free"?"FREE":"£"+servicePrice}</span><button class="dashed-area-delete-btn" onclick="removeService()"><i class="fa-solid fa-trash"></i></button>`
                                servicePool.appendChild(newService)
                                updateService()
                            }
                            function removeService(){
                                event.preventDefault()
                                event.target.parentNode.parentNode.remove()
                                updateService()
                            }
                        </script>
                    </div>
                </div>
            </div>
            {{-- OBJECTIVES AREA --}}
            <div class="section-row">
                <div class="dashed-area" id="servicesArea">
                    @forelse (json_decode($invoice->services) as $service )
                        <div class="dashed-area-item" style="max-width: calc(456px - 1rem);">
                            <span class="hashtag">#</span><span class="serviceName">{{ $service->name }}</span> - <span class="sevicePrice">{{ $service->price=="FREE"?"FREE":"£".$service->price }}</span><button class="dashed-area-delete-btn" onclick="removeService()"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>

            <script>
                updateService()
            </script>

            <div class="section-row">
                <div class="section-col">
                    <select name="project_id" required>
                        @foreach ($projects as $pj )
                            @if ($pj->id==$invoice->project->id)
                            <option value="{{ $pj->id }}" selected>{{ $pj->business->name }}'s project</option>
                            @else
                                <option value="{{ $pj->id }}">{{ $pj->business->name }}'s project</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
                <div class="section-row">
                    <p style="display:flex;justify-content:center;align-items:center;gap:.5rem"><input type="checkbox" @if ($invoice->is_paid) checked @endif name="isPaid">
                    <span>Check if the invoice is paid</span></p>
                </div>
                <div class="section-row">
                    <div class="section-col reverse">
                        <button type="submit">EDIT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
