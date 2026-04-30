@php
    use App\Helpers\AdminMenuHelper;
    use App\Helpers\MenuHelper;

    $menuGroups = AdminMenuHelper::menu();
    $currentRoute = request()->route()->getName();
@endphp

<aside id="sidebar"
    class="fixed xl:relative flex flex-shrink-0 flex-col top-0 left-0 px-5 bg-white dark:bg-gray-900 dark:border-gray-800 text-gray-900 h-screen transition-all duration-300 ease-in-out z-[99999] border-r border-gray-200"
    x-data="{
        openSubmenus: {},
        init() {
            this.initializeActiveMenus();
        },
        initializeActiveMenus() {
            const currentRoute = '{{ $currentRoute }}';

            @foreach ($menuGroups as $groupIndex => $menuGroup)
                @foreach ($menuGroup['items'] as $itemIndex => $item)
                    @if (isset($item['subItems']))
                        @foreach ($item['subItems'] as $subItem)
                            if (currentRoute.startsWith('{{ $subItem['route'] }}')) {
                                this.openSubmenus['{{ $groupIndex }}-{{ $itemIndex }}'] = true;
                            }
                        @endforeach
                    @endif
                @endforeach
            @endforeach
        },
        toggleSubmenu(groupIndex, itemIndex) {
            const key = groupIndex + '-' + itemIndex;
            const newState = !this.openSubmenus[key];
            if (newState) {
                this.openSubmenus = {};
            }
            this.openSubmenus[key] = newState;
        },
        isSubmenuOpen(groupIndex, itemIndex) {
            const key = groupIndex + '-' + itemIndex;
            return this.openSubmenus[key] || false;
        },
        isActive(route) {
            return '{{ $currentRoute }}'.startsWith(route);
        }
    }"
    :class="{
        'w-[290px]': $store.sidebar.isExpanded || $store.sidebar.isMobileOpen || $store.sidebar.isHovered,
        'w-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen,
        'translate-x-0': $store.sidebar.isMobileOpen || $store.sidebar.isExpanded || $store.sidebar.isHovered,
        '-translate-x-full': !$store.sidebar.isMobileOpen && !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
        'xl:translate-x-0': true
    }"
    @mouseenter="if (!$store.sidebar.isExpanded) $store.sidebar.setHovered(true)"
    @mouseleave="$store.sidebar.setHovered(false)">

    <!-- Logo -->
    <div class="pt-8 pb-7 flex"
        :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen)
            ? 'xl:justify-center' : 'justify-start'">
        <a href="{{ route('admin.dashboard') }}">
            <img x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                class="dark:hidden" src="/images/logo/logo.svg" width="150" />
            <img x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                class="hidden dark:block" src="/images/logo/logo-dark.svg" width="150" />
            <img x-show="!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen"
                src="/images/logo/logo-icon.svg" width="32" />
        </a>
    </div>

    <!-- MENU -->
    <div class="flex flex-col overflow-y-auto no-scrollbar">
        <nav class="mb-6">
            <div class="flex flex-col gap-4">

                @foreach ($menuGroups as $groupIndex => $menuGroup)
                    <div>
                        <!-- GROUP TITLE -->
                        <h2 class="mb-4 text-xs uppercase flex leading-[20px] text-gray-400"
                            x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">
                            <span>{{ $menuGroup['title'] }}</span>
                        </h2>

                        <ul class="flex flex-col gap-1">
                            @foreach ($menuGroup['items'] as $itemIndex => $item)
                                <li>
                                    @if (isset($item['subItems']))
                                        <!-- SUBMENU TRIGGER -->
                                        <button
                                            @click="toggleSubmenu({{ $groupIndex }}, {{ $itemIndex }})"
                                            class="menu-item group w-full"
                                            :class="isSubmenuOpen({{ $groupIndex }}, {{ $itemIndex }})
                                                ? 'menu-item-active' : 'menu-item-inactive'">
                                            <span>
                                                {!! class_exists(\App\Helpers\MenuHelper::class)
                                                    ? MenuHelper::getIconSvg($item['icon'] ?? 'default')
                                                    : '' !!}
                                            </span>
                                            <span class="menu-item-text flex items-center gap-2"
                                                x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">
                                                {{ $item['name'] }}
                                            </span>
                                            <svg class="ml-auto w-5 h-5 transition-transform duration-200"
                                                x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                                :class="{ 'rotate-180 text-brand-500': isSubmenuOpen({{ $groupIndex }}, {{ $itemIndex }}) }"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>

                                        <!-- SUBMENU LIST -->
                                        <div x-show="isSubmenuOpen({{ $groupIndex }}, {{ $itemIndex }}) && ($store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen)">
                                            <ul class="mt-2 space-y-1 ml-9">
                                                @foreach ($item['subItems'] as $subItem)
                                                    <li>
                                                        <a href="{{ route($subItem['route']) }}"
                                                            class="menu-dropdown-item"
                                                            :class="isActive('{{ $subItem['route'] }}')
                                                                ? 'menu-dropdown-item-active'
                                                                : 'menu-dropdown-item-inactive'">
                                                            {{ $subItem['name'] }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    @else
                                        <!-- SINGLE MENU ITEM -->
                                        <a href="{{ route($item['route']) }}"
                                            class="menu-item group"
                                            :class="isActive('{{ $item['route'] }}')
                                                ? 'menu-item-active'
                                                : 'menu-item-inactive'">
                                            <span>
                                                {!! class_exists(\App\Helpers\MenuHelper::class)
                                                    ? MenuHelper::getIconSvg($item['icon'] ?? 'default')
                                                    : '' !!}
                                            </span>
                                            <span class="menu-item-text flex items-center gap-2"
                                                x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">
                                                {{ $item['name'] }}
                                            </span>
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach

            </div>
        </nav>
    </div>
</aside>

<!-- Mobile Overlay -->
<div x-show="$store.sidebar.isMobileOpen"
    x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click="$store.sidebar.setMobileOpen(false)"
    class="fixed inset-0 z-[99998] bg-gray-900/50 xl:hidden"></div>