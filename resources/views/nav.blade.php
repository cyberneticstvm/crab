<header class="main-nav">
    <div class="sidebar-user text-center"><a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="{{ asset('/assets/docs/crab-logo.jpeg') }}" alt="">
        <div class="badge-bottom"><span class="badge badge-primary">{{ Auth::user()->role }}</span></div><a href="#">
            <h6 class="mt-3 f-14 f-w-600">{{ Auth::user()->name }}</h6>
        </a>
        <p class="mb-0 font-roboto">{{ Auth::user()->email }}</p>
        <ul>
            <li><span>₹<span class="counter">{{ totDonationAmount() }}</span></span>
                <p>Donations</p>
            </li>
            <li><span><span class="counter">{{ totDonorCount() }}</span></span>
                <p>Donors </p>
            </li>
        </ul>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>General </h6>
                        </div>
                    </li>
                    <!--<li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="home"></i><span>Dashboard</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        </ul>
                    </li>-->
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="airplay"></i><span>Administration</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ route('member.register', 'contributor') }}">Well-wishers</a></li>
                            <li><a href="{{ route('member.register', 'member') }}">Members</a></li>
                            <li><a href="{{ route('contribution.register') }}">Donations</a></li>
                            <li><a href="{{ route('message.register', 'regular') }}">Messages</a></li>
                            <li><a href="{{ route('message.register', 'custom') }}">Custom Messages</a></li>
                            <li><a href="{{ route('custom.message.register') }}">Message Sent List</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>