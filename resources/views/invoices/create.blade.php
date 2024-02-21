@extends('layouts.main')
@section('content')
<x-breadcrum :data="$breadcrum"/>
    <div class="main">
        <div class="form-container" style="width: 40%">
            @if (count($projects) > 0)
                <form action="{{route('invoices.store')}}" method="POST" class="form-section" >
                    @csrf
                    <div class="section-row">
                        <h2 class="subtitle">Create an invoice</h2>
                    </div>

                <div class="section-row">
                    <div class="section-col">
                        <input type="text" name="services_input" id="services_input" hidden>
                        <p class="form-error" id="nameErrorField"></p>
                        <div class="section-row row">
                            <input  class="field" id="serviceName" type="text" placeholder="Service/Product">
                            <input  class="field" id="serviceQuantity" type="number" placeholder="Quantity">
                            <input  class="field" id="servicePrice" type="number" placeholder="Price">
                            <button type="none" onclick="addService()">ADD</button>
                            <script>
                                function updateService(){
                                    let servicesInput = document.querySelector("#services_input")
                                    let sevicesPoolItems = document.querySelectorAll(".dashed-area-item")
                                    let services = []
                                    sevicesPoolItems.forEach(element => {
                                        let price = element.children.item(3).innerText;
                                        let quantity = element.children.item(2).innerText.length ? Number(element.children.item(2).innerText) : 1
                                        services.push([element.children.item(1).innerText, price=="FREE"? price : Number(price.slice(1)), quantity ])
                                    });
                                    console.log(services);
                                    servicesInput.value = services
                                }
                                function addService(){
                                    event.preventDefault()
                                    let serviceName = document.querySelector("#serviceName").value
                                    let serviceQuantity = document.querySelector("#serviceQuantity").value.length ? document.querySelector("#serviceQuantity").value : 1
                                    let servicePrice = document.querySelector("#servicePrice").value == ""?"Free":document.querySelector("#servicePrice").value
                                    // leave if null
                                    if(serviceName.length == 0|| serviceQuantity.length == 0 || servicePrice.length == 0) return

                                    let servicePool = document.querySelector("#servicesArea");
                                    newService = document.createElement("div");
                                    newService.className = "dashed-area-item"
                                    newService.style = "max-width: calc(456px - 1rem);"
                                    newService.innerHTML = `<span class="hashtag">#</span><span class="serviceName">${serviceName}</span> - <span class="serviceName">${serviceQuantity}</span> - <span class="sevicePrice">${servicePrice=="Free"?"FREE":"£"+servicePrice}</span><button class="dashed-area-delete-btn" onclick="removeService()"><i class="fa-solid fa-trash"></i></button>`
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

                    </div>
                </div>


                    <div class="section-row">
                        <div class="section-col">
                            <select name="project_id" required>
                                <option value="">Select Business</option>
                                @foreach ($projects as $pj )
                                    @if ($project && $pj->id==$project->id)
                                    <option value="{{ $pj->id }}" selected>{{ $pj->business->name }}'s project</option>
                                    @else
                                        <option value="{{ $pj->id }}">{{ $pj->business->name }}'s project</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="section-row">
                        <p style="display:flex;justify-content:center;align-items:center;gap:.5rem"><input type="checkbox" name="isPaid">
                        <span>Check if the invoice is paid</span></p>
                    </div>
                    <div class="section-row">
                        <div class="section-col reverse">
                            <button type="submit">ADD</button>
                        </div>
                    </div>
                </form>
            @else
                <p>No projects found without an invoice</p>
                <a href="{{route('projects.create')}}">ADD A PROJECT</a>
            @endif
            
        </div>
    </div>
    </div>
@endsection
