<div class="breadcrum">

    <div class="breadcrum-section">
        @foreach ($data['tabs'] as $tab)
            <a href="{{$tab['url']}}"  class="breadcrum-tab {{$tab['isActive'] ? 'active' : ''}}">
                @if ($tab['isHome'])
                    <i class="fa-solid fa-house"></i>
                @endif
                {{$tab['text']}}
            </a >
        @endforeach
    </div>

    <div class="breadcrum-section">

    </div>
    
    <div class="breadcrum-section">
        @if ($data['actionBtn'])
            <a href="{{$data['actionBtn']['url']}}">
                <button class="success-bg">{{$data['actionBtn']['text']}}</button>
            </a>
        @endif  
    </div>
</div>