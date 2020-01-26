<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('student') }}'><i class='nav-icon fa fa-group'></i> Students</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('company') }}'><i class='nav-icon fa fa-company'></i> Companies</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('school') }}'><i class='nav-icon fa fa-school'></i> Schools</a></li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-group"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon fa fa-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon fa fa-group"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon fa fa-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('report') }}'><i class='nav-icon fa fa-bar-chart'></i> <span>Reports</span></a></li>