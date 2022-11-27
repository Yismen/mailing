<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('report.admin.dashboard.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('report.about') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>
                        {{ __('About') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        {{ __('Human Resource Links') }}
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    @can('viewAny', \Dainsys\Report\Models\Afp::class)
                    <li class="nav-item">
                        <a href="{{ route('report.admin.afps.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Afps') }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\Report\Models\Ars::class)
                    <li class="nav-item">
                        <a href="{{ route('report.admin.arss.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Arss') }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\Report\Models\Bank::class)
                    <li class="nav-item">
                        <a href="{{ route('report.admin.banks.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Banks') }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\Report\Models\Citizenship::class)
                    <li class="nav-item">
                        <a href="{{ route('report.admin.citizenships.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Citizenships') }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\Report\Models\Department::class)
                    <li class="nav-item">
                        <a href="{{ route('report.admin.departments.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Departments') }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\Report\Models\PaymentType::class)
                    <li class="nav-item">
                        <a href="{{ route('report.admin.payment_types.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Payment Types') }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\Report\Models\Position::class)
                    <li class="nav-item">
                        <a href="{{ route('report.admin.positions.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Positions') }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\Report\Models\Project::class)
                    <li class="nav-item">
                        <a href="{{ route('report.admin.projects.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Projects') }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\Report\Models\Site::class)
                    <li class="nav-item">
                        <a href="{{ route('report.admin.sites.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Sites') }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\Report\Models\Supervisor::class)
                    <li class="nav-item">
                        <a href="{{ route('report.admin.supervisors.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Supervisors') }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\Report\Models\TerminationType::class)
                    <li class="nav-item">
                        <a href="{{ route('report.admin.termination_reasons.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Termination Reasons') }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\Report\Models\TerminationReason::class)
                    <li class="nav-item">
                        <a href="{{ route('report.admin.termination_types.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Termination Types') }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\Report\Models\Employee::class)
                    <li class="nav-item">
                        <a href="{{ route('report.admin.employees.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Employees') }}</p>
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