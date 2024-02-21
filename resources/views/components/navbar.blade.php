<nav class="header-nav">
    <div class="nav-left">
        <div class="logo">
            <img class="logo-img" src="{{asset('assets/setrun_logo_white_nobg.png')}}" alt="LOGO">
            <p class="logo-text">SETRUN_</p>
        </div>
    </div>
    <div class="nav-center">

    </div>
    <div class="nav-right">
        <div class="nav-tab">
            <a class="nav-link {{$ParentPageName == 'dashboard' ? 'active' : ''}}" href="{{route('dashboard')}}">DASHBOARD</a>
        </div>

        <div class="nav-tab">
            <a onmouseover="showDropdown('business-dropdown')" onmouseout="hideDropdown('business-dropdown')" class="nav-link dropdownBtn {{$ParentPageName == 'businesses' ? 'active' : ''}}" href="{{route('businesses.index')}}">BUSINESSES <i class="fa-solid fa-chevron-down"></i></a>
            <div id="business-dropdown" class="nav-tab-dropdown dropdown">
                <div class="nav-tab">
                    <a class="nav-link  dropdown-item" href="{{route('businesses.index')}}">ALL BUSINESSES</a>
                </div>
                <div class="nav-tab">
                    <a class="nav-link  dropdown-item" href="{{route('businesses.create')}}">NEW BUSINESS</a>
                </div>
                <div class="nav-tab">
                    <a class="nav-link  dropdown-item" href="{{route('businesses.bulk-create')}}">BULK CREATE</a>
                </div>
            </div>
        </div>

        <div class="nav-tab">
            <a onmouseover="showDropdown('project-dropdown')" onmouseout="hideDropdown('project-dropdown')" class="nav-link dropdownBtn {{$ParentPageName == 'projects' ? 'active' : ''}}" href="{{route('projects.index')}}">PROJECTS <i class="fa-solid fa-chevron-down"></i></a>
            <div id="project-dropdown" class="nav-tab-dropdown dropdown">
                <div class="nav-tab">
                    <a class="nav-link  dropdown-item" href="{{route('projects.index')}}">ALL PROJECTS</a>
                </div>
                <div class="nav-tab">
                    <a class="nav-link  dropdown-item" href="{{route('projects.index')}}?status=ongoing">ONGOING PROJECTS</a>
                </div>
                <div class="nav-tab">
                    <a class="nav-link  dropdown-item" href="{{route('projects.index')}}?status=completed">COMPLETED PROJECTS</a>
                </div>
                <div class="nav-tab">
                    <a class="nav-link  dropdown-item" href="{{route('projects.create')}}" >NEW PROJECT</a>
                </div>
            </div>
        </div>

        <div class="nav-tab">
            <a class="nav-link {{$ParentPageName == 'invoices' ? 'active' : ''}}" href="{{route('invoices.index')}}">INVOICES</a>
        </div>
        <div class="nav-tab">
            <p class="nav-link" onmouseover="showDropdown('user-dropdown')" onmouseout="hideDropdown('user-dropdown')">{{Auth::user()->name}}<i class="fa-solid fa-user"></i></p>
            <div id="user-dropdown" class="nav-tab-dropdown dropdown">
                <div class="nav-tab">
                    <a class="nav-link  dropdown-item" href="#">MY PROFILE</a>
                </div>
                <div class="nav-tab">
                    <a class="nav-link  dropdown-item" href="#">SETTINGS</a>
                </div>
                <form action="{{route('logout')}}" method="POST" class="nav-tab">
                    @csrf
                    <button class="not-button dropdown-item">LOG OUT</button>
                </form>
            </div>
        </div>

    </div>
    {{-- mobile menu trigger --}}
    <div id="mobile-trigger">
        <div class="lines-container">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    {{-- mobile menu --}}
    <nav class="header-mobile">
        <div data-acc="projects" class="nav-tab">
            <a class="nav-link {{$ParentPageName == 'dashboard' ? 'active' : ''}}" href="/">DASHBOARD</a>
        </div>
        
        <div class="nav-tab accordion">
            <div data-acc="projects" class="accordion-trigger {{$ParentPageName == 'businesses' ? 'active' : ''}}">
                BUSINESSES <i class="fa-solid fa-chevron-down trigger-arrow"></i>
            </div>
            <div id="projects" class="accordion-detail">
                <div class="nav-tab">
                    <a class="nav-link" href="{{route('businesses.index')}}">ALL BUSINESSES</a>
                </div>
                <div class="nav-tab">
                    <a class="nav-link" href="{{route('businesses.create')}}">NEW BUSINESS</a>
                </div>
                <div class="nav-tab">
                    <a class="nav-link" href="{{route('businesses.bulk-create')}}">BULK CREATE</a>
                </div>
            </div>
        </div>

        <div class="nav-tab accordion">
            <div data-acc="projects" class="accordion-trigger {{$ParentPageName == 'projects' ? 'active' : ''}}">
                PROJECTS <i class="fa-solid fa-chevron-down trigger-arrow"></i>
            </div>
            <div id="projects" class="accordion-detail">
                <div class="nav-tab">
                    <a class="nav-link" href="{{route('projects.index')}}">ALL PROJECTS</a>
                </div>
                <div class="nav-tab">
                    <a class="nav-link" href="{{route('projects.index')}}?status=ongoing">ONGOING PROJECTS</a>
                </div>
                <div class="nav-tab">
                    <a class="nav-link" href="{{route('projects.index')}}?status=completed">COMPLETED PROJECTS</a>
                </div>
                <div class="nav-tab">
                    <a class="nav-link" href="{{route('projects.create')}}" >NEW PROJECT</a>
                </div>
            </div>
        </div>

        <div data-acc="projects" class="nav-tab {{$ParentPageName == 'invoices' ? 'active' : ''}}">
            <a class="nav-link {{$ParentPageName == 'invoices' ? 'active' : ''}}" href="{{route('invoices.index')}}">INVOICES</a>
        </div>

        <div class="nav-tab accordion">
            <div data-acc="projects" class="accordion-trigger {{$ParentPageName == 'projects' ? 'active' : ''}}">
                MY ACCOUNT <i class="fa-solid fa-chevron-down trigger-arrow"></i>
            </div>
            <div id="projects" class="accordion-detail">
                <div class="nav-tab">
                    <a class="nav-link  dropdown-item" href="#">MY PROFILE</a>
                </div>
                <div class="nav-tab">
                    <a class="nav-link  dropdown-item" href="#">SETTINGS</a>
                </div>
                <form action="{{route('logout')}}" method="POST" class="nav-tab">
                    @csrf
                    <button class="not-button dropdown-item">LOG OUT</button>
                </form>
            </div>
        </div>
    </nav>
</nav>


{{-- MOBILE MENU SCRIPT--}}
<script type="module" src="{{asset('js/mobile-menu.js')}}"></script>
<script src="{{asset('js/accordion.js')}}"></script>