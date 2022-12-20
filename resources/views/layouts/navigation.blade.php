<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            {{-- <li class="nav-item">
                <a href="{{ route('mailing.admin.dashboard.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('mailing::messages.dashboard') }}
                    </p>
                </a>
            </li> --}}

            <li class="nav-item">
                <a href="{{ route('mailing.about') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>
                        {{ __('mailing::messages.about') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('mailing.admin.dashboard') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>
                        {{ __('mailing::messages.dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        {{ __('mailing::messages.mailing_links') }}
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    @can('viewAny', \Dainsys\Mailing\Models\Mailable::class)
                    <li class="nav-item">
                        <a href="{{ route('mailing.admin.mailables.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('mailing::messages.mailables') }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\Mailing\Models\Recipient::class)
                    <li class="nav-item">
                        <a href="{{ route('mailing.admin.recipients.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('mailing::messages.recipients') }}</p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->