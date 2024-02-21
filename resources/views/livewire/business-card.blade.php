<div class="card">
    @if ($business->status == 2)
        <div class="corner-icon {{date('Y-m-d')<date('Y-m-d', strtotime($business->recontact_at)) ? 'primary' : 'error'}}">
            <i class="fa-solid fa-arrow-rotate-right icon " ></i> {{date('d-m-Y', strtotime($business->recontact_at))}}
        </div>
    @elseif($business->status == 4)
        <div class="corner-icon warning">
            <i class="fa-solid fa-ban icon " ></i> No Answer
        </div>
    @endif
    <i class="fa-solid fa-ellipsis-vertical card-ellipsis icon dropdownBtn" onclick="toggleDropdown('cardOptions{{$business->id}}')" ></i>
<div id="cardOptions{{$business->id}}" class="card-options dropdown visibleOnHoverOut">
    <a href="{{route('businesses.edit', ['business' => $business->id])}}">
        <div class="card-option">
            EDIT BUSINESS
        </div>
    </a>
    @if ($business->status == 1)
    <button  class="card-option not-button" onclick="showModal('business-modal-{{$business->id}}')">
        RECONTACT LATER
    </button> 
    @endif

    @if ($business->status != 3)
        @if ($business->status != 1)
        <button wire:click="noAnswer" class="card-option not-button">
            NO ANSWER
        </button> 
        @endif
    <button wire:click="markAsUnavailable" class="card-option not-button">
        UNAVAILABLE
    </button> 
    @endif

    <form action="{{route('businesses.destroy', ['business' => $business->id])}}" method="post">
        @csrf
        @method('DELETE')
        <button class="card-option not-button delete">
            DELETE BUSINESS
        </button>    
    </form>
</div>
<div class="card-section column  nogap border-bottom">
    <div class="card-block center">
        <a href="{{route('businesses.show', ['business'=>$business->id])}}"><h2>{{$business->name}}</h2> </a>
    </div>
    <div class="card-block center">
        <p class="light-text">{{$business->niche}}</p>
    </div>
</div>
<div class="card-section column left">
    <div onclick="copyToClipboard('{{$business->address}}')" class="card-block hoverable">
        <p class="short-text"><i class="fa-solid fa-location-dot  icon mini"></i> {{$business->address}}  </p>
        <i class="fa-solid fa-copy icon card-icon"></i>
    </div>
    @if ($business->website)
        <div onclick="openUrl('{{$business->website}}')" class="card-block hoverable">
            <i class="fa-solid fa-globe icon mini"></i> <a href="#" class="url" >{{ $business->website }}</a>
            <i class="fa-solid fa-arrow-up-right-from-square icon card-icon"></i>
        </div>
    @else
        <div class="card-block ">
            <i class="fa-solid fa-globe icon mini light-text"></i> <p class="light-text">HAS NO WEBSITE.</p>
            <i class="fa-solid fa-arrow-up-right-from-square icon card-icon"></i>
        </div>
    @endif
    <div onclick="copyToClipboard('{{$business->number}}')" class="card-block hoverable">
        <i class="fa-solid fa-phone icon mini"></i> <p class="short-text">{{$business->number}}</p>
        <i class="fa-solid fa-copy icon card-icon"></i>
    </div>
</div>
<div class="card-section">
    @if ($business->status == 3)
    <p class="error">UNVAILABLE</i></p>
    @elseif ($business->status == 1)
    <p class="success"><i class="fa-solid fa-check"></i> Contacted by {{$business->contacted_by == Auth::user()->id ? 'you ': $business->contacter->name }} </p>
    @else
    <button class="success" wire:click="markAsContacted">MARK AS CONTACTED</button>
    @endif
</div>

{{-- RECONTACT MODEL --}}
<div class="modal-container" id="business-modal-{{$business->id}}">
    <div class="modal-box form-container">
        <form action="#" class="form-section">
            <div class="section-row">
                <h2 class="subtitle">Select Recontact Date</h2>
            </div>
            <div class="section-row">
                <div class="section-col">
                    @error('recontactDate')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <input class="field" wire:model="recontactDate" type="date">
                </div>
            </div>

            <div class="section-row">
                <div class="section-col reverse">
                    <button class="secondary-btn" onclick="hideModal('business-modal-{{$business->id}}')">CANCEL</button>
                    <button wire:click.prevent="contactLater">SUBMIT</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
