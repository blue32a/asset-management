<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fa-solid fa-house"></i><p>Home</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('summary') }}" @class(['nav-link', 'active' => Route::currentRouteName() === 'summary'])>
                        <i class="nav-icon fas fa-file"></i><p>Summary</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
