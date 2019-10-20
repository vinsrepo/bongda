<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" navigation-header">
                <span>Cogamichi</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right"
                                       data-original-title="General"></i>
            </li>
            <li class=" nav-item {{ Request::is('admin/codes') ? 'active' : '' }}"><a href="/admin/codes"><i class="ft-home"></i><span class="menu-title" data-i18n="">Quản lý mã code</span></a></li>

            <li class=" nav-item {{ Request::is('admin/users') ? 'active' : '' }}"><a href="/admin/users"><i class="ft-home"></i><span class="menu-title" data-i18n="">Quản trị viên</span></a></li>
            <!-- <li class=" nav-item {{ Request::is('admin') ? 'active' : '' }}"><a href="/admin"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a></li> -->

            <!-- <li class=" nav-item {{ (Request::is('admin/users*') || Request::is('admin/customers*')) ? 'open' : '' }}"><a href="#"><i class="ft-users"></i><span class="menu-title" data-i18n="">Quản lý người dùng</span></a>
                <ul class="menu-content">
                    <li class="{{-- {{ Request::is('admin/users') ? 'active' : '' }} --}}"><a class="menu-item" href="/admin/users">Quản trị viên</a>
                    </li>
                    <li class="{{-- {{ Request::is('admin/users') ? 'active' : '' }} --}}"><a class="menu-item" href="/admin/users">Tư vấn viên</a>
                    </li>
                    <li class="{{ Request::is('admin/customers') ? 'active' : '' }}"><a class="menu-item" href="/admin/customers">Khách hàng</a>
                    </li>
                </ul>
            </li> -->

            <!-- <li class=" nav-item {{ Request::is('admin/posts') ? 'active' : '' }}"><a href="/admin/posts"><i class="ft-home"></i><span class="menu-title" data-i18n="">Quản lý bài viết</span></a></li> -->

            <li class=" nav-item {{ Request::is('admin/introduce') ? 'active' : '' }}"><a href="/admin/introduce"><i class="ft-home"></i><span class="menu-title" data-i18n="">Quản lý nội dung tĩnh</span></a></li>

            <!-- <li class=" nav-item {{ Request::is('admin/history') ? 'active' : '' }}"><a href="/admin/history"><i class="fa fa-history"></i><span class="menu-title" data-i18n="">History</span></a></li> -->
        </ul>
    </div>
</div>
