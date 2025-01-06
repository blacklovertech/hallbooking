<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <!-- Dashboard Menu -->
            <li class="">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-tachometer-alt"></i> <span>Dashboard</span>
                </a>
            </li>

            <!-- Hall Menu -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-university"></i>
                    <span>Hall</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.halls.index') }}"><i class="fa fa-list"></i>
                            <span>Hall List</span></a></li>
                    <li><a href="{{ route('admin.halls.create') }}"><i class="fa fa-plus-circle"></i>
                            <span>Hall Add</span></a></li>
                </ul>
            </li>

            <!-- Amenities Menu -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span>Amenities</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.amenities.index') }}"><i class="fa fa-cogs"></i>
                            <span>Amenities List</span></a></li>
                    <li><a href="{{ route('admin.amenities.create') }}"><i class="fa fa-plus-circle"></i>
                            <span>Amenities Add</span></a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.users.index') }}"><i class="fa fa-list"></i>
                            <span>User List</span></a></li>
                    <li><a href="{{ route('admin.users.create') }}"><i class="fa fa-plus-circle"></i>
                            <span>Add User</span></a></li>
                </ul>
            </li>

                 <!-- Amenities Menu -->
                 <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span>Bookings</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.bookings.index') }}"><i class="fa fa-cogs"></i>
                            <span>Bookings List</span></a></li>
                    <li><a href="{{ route('admin.bookings.create') }}"><i class="fa fa-plus-circle"></i>
                            <span>Bookings Add</span></a></li>
                </ul>
            </li>
            <li class="">
                <a href="{{ route('admin.calendar.index') }}">
                    <i class="fa fa-calendar"></i> <span>Calendar </span>
                </a>
            </li>
            <!-- Change Password -->
            <li class="">
                <a data-target="#changepassword" data-toggle="modal" href="{{ route('change_password') }}">
                    <i class="fa fa-key"></i> <span>Change Password</span>
                </a>
            </li>

            <!-- Logout Menu -->
            <li class="">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out-alt"></i> <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </section>
</aside>

<!-- Change Password Modal -->
<div id="changepassword" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal content will be loaded dynamically -->
        </div>
    </div>
</div>

<!-- Sidebar Toggle Script -->
<script>
$(document).ready(function() {
    // Sidebar toggle functionality for sidebar-menu items (treeview)
    $(".sidebar-toggle").click(function() {
        $("body").toggleClass("sidebar-collapse");
    });

    // Modal Loading for Change Password
    $("#changepassword").on("show.bs.modal", function(e) {
        var link = $(e.relatedTarget);
        $(this).find(".modal-content").load(link.attr("href"));
    });
});
</script>