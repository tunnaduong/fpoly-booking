@php
    $navLinks = [
        [
            'icon' => 'icon-grid',
            'title' => 'Bảng điều khiển',
            'href' => BASE_URL,
            'havingArrow' => false,
            'id' => 'dashboard',
        ],
        [
            'icon' => 'mdi mdi-magnify',
            'title' => 'Tìm kiếm',
            'href' => '/search',
            'id' => 'search',
            'havingArrow' => false,
        ],
        [
            'icon' => 'mdi mdi-door-closed',
            'title' => 'Quản lý phòng',
            'href' => '/room/manage',
            'id' => 'room-manage',
            'havingArrow' => false,
        ],
        [
            'icon' => 'mdi mdi-plus',
            'title' => 'Đặt phòng',
            'href' => '/room/book',
            'id' => 'room-book',
            'havingArrow' => false,
        ],
        [
            'icon' => 'mdi mdi-calendar-clock',
            'title' => 'Lịch trình',
            'href' => '/schedule',
            'id' => 'schedule',
            'havingArrow' => false,
        ],
        [
            'icon' => 'mdi mdi-history',
            'title' => 'Lịch sử',
            'href' => '/history',
            'id' => 'history',
            'havingArrow' => false,
        ],
        [
            'icon' => 'mdi mdi-finance',
            'title' => 'Thống kê',
            'href' => '/statistic',
            'id' => 'statistic',
            'havingArrow' => false,
        ],
        [
            'icon' => 'icon-head',
            'title' => 'Người dùng',
            'href' => '/user/manage',
            'id' => 'user-manage',
            'havingArrow' => false,
        ],
    ];
@endphp



<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @foreach ($navLinks as $navLink)
            <li class="nav-item">
                <a class="nav-link" href="{{ $navLink['href'] }}" {!! $navLink['havingArrow'] == true
                    ? 'data-toggle="collapse" aria-expanded="false" aria-controls="' . $navLink['id'] . '"'
                    : '' !!}>
                    <i class="{{ $navLink['icon'] }} menu-icon"></i>
                    <span class="menu-title">{{ $navLink['title'] }}</span>
                    @unless ($navLink['havingArrow'] == false)
                        <i class="menu-arrow"></i>
                    @endunless
                </a>
                @if (isset($navLink['subMenu']))
                    <div class="collapse" id="{{ $navLink['id'] }}">
                        <ul class="nav flex-column sub-menu">
                            @foreach ($navLink['subMenu'] as $subMenu)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ $subMenu['href'] }}">{{ $subMenu['title'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
