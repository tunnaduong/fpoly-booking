@php
    $navLinks = [
        [
            'icon' => 'icon-grid',
            'title' => 'Dashboard',
            'href' => BASE_URL_ADMIN,
        ],
        [
            'icon' => 'icon-layout',
            'title' => 'UI Elements',
            'href' => '#ui-basic',
            'subMenu' => [
                [
                    'title' => 'Buttons',
                    'href' => 'pages/ui-features/buttons.html',
                ],
                [
                    'title' => 'Dropdowns',
                    'href' => 'pages/ui-features/dropdowns.html',
                ],
                [
                    'title' => 'Typography',
                    'href' => 'pages/ui-features/typography.html',
                ],
            ],
        ],
        [
            'icon' => 'icon-columns',
            'title' => 'Form elements',
            'href' => '#form-elements',
            'subMenu' => [
                [
                    'title' => 'Basic Elements',
                    'href' => 'pages/forms/basic_elements.html',
                ],
            ],
        ],
        [
            'icon' => 'icon-bar-graph',
            'title' => 'Charts',
            'href' => '#charts',
            'subMenu' => [
                [
                    'title' => 'ChartJs',
                    'href' => 'pages/charts/chartjs.html',
                ],
            ],
        ],
        [
            'icon' => 'icon-grid-2',
            'title' => 'Tables',
            'href' => '#tables',
            'subMenu' => [
                [
                    'title' => 'Basic table',
                    'href' => 'pages/tables/basic-table.html',
                ],
            ],
        ],
        [
            'icon' => 'icon-contract',
            'title' => 'Icons',
            'href' => '#icons',
            'subMenu' => [
                [
                    'title' => 'Mdi icons',
                    'href' => 'pages/icons/mdi.html',
                ],
            ],
        ],
        [
            'icon' => 'icon-head',
            'title' => 'User Pages',
            'href' => '#auth',
            'subMenu' => [
                [
                    'title' => 'Login',
                    'href' => 'pages/samples/login.html',
                ],
                [
                    'title' => 'Register',
                    'href' => 'pages/samples/register.html',
                ],
            ],
        ],
    ];
@endphp



<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @foreach ($navLinks as $navLink)
            <li class="nav-item">
                <a class="nav-link" href="{{ $navLink['href'] }}">
                    <i class="{{ $navLink['icon'] }} menu-icon"></i>
                    <span class="menu-title">{{ $navLink['title'] }}</span>
                </a>
                @if (isset($navLink['subMenu']))
                    <div class="collapse" id="{{ $navLink['href'] }}">
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
