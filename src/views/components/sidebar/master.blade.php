@php
    $navLinks = [
        [
            'icon' => 'icon-grid',
            'title' => 'Dashboard',
            'href' => BASE_URL_ADMIN,
            'havingArrow' => false,
            'id' => 'dashboard',
        ],
        [
            'icon' => 'icon-layout',
            'title' => 'UI Elements',
            'href' => '#ui-basic',
            'id' => 'ui-basic',
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
            'havingArrow' => true,
        ],
        [
            'icon' => 'icon-columns',
            'title' => 'Form elements',
            'href' => '#form-elements',
            'id' => 'form-elements',
            'subMenu' => [
                [
                    'title' => 'Basic Elements',
                    'href' => 'pages/forms/basic_elements.html',
                ],
            ],
            'havingArrow' => true,
        ],
        [
            'icon' => 'icon-bar-graph',
            'title' => 'Charts',
            'href' => '#charts',
            'id' => 'charts',
            'subMenu' => [
                [
                    'title' => 'ChartJs',
                    'href' => 'pages/charts/chartjs.html',
                ],
            ],
            'havingArrow' => true,
        ],
        [
            'icon' => 'icon-grid-2',
            'title' => 'Tables',
            'href' => '#tables',
            'id' => 'tables',
            'subMenu' => [
                [
                    'title' => 'Basic table',
                    'href' => 'pages/tables/basic-table.html',
                ],
            ],
            'havingArrow' => true,
        ],
        [
            'icon' => 'icon-contract',
            'title' => 'Icons',
            'href' => '#icons',
            'id' => 'icons',
            'subMenu' => [
                [
                    'title' => 'Mdi icons',
                    'href' => 'pages/icons/mdi.html',
                ],
            ],
            'havingArrow' => true,
        ],
        [
            'icon' => 'icon-head',
            'title' => 'User Pages',
            'href' => '#auth',
            'id' => 'auth',
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
            'havingArrow' => true,
        ],
    ];
@endphp



<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @foreach ($navLinks as $navLink)
            <li class="nav-item">
                <a class="nav-link" href="{{ $navLink['href'] }}" data-toggle="collapse" aria-expanded="false"
                    aria-controls="{{ $navLink['id'] }}">
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
