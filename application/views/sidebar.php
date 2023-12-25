<style>
    .sidebar-menu {
        list-style: none;
        margin: 0;
        padding: 0;
        background-color: #222d32;
    }

    .sidebar-menu>li {
        position: relative;
        margin: 0;
        padding: 0;
    }

    .sidebar-menu>li>a {
        padding: 12px 5px 12px 15px;
        display: block;
        border-left: 3px solid transparent;
        color: #b8c7ce;
    }

    .sidebar-menu>li>a>.fa {
        width: 20px;
    }

    .sidebar-menu>li:hover>a,
    .sidebar-menu>li.active>a {
        color: #fff;
        background: #1e282c;
        border-left-color: #3c8dbc;
    }

    .sidebar-menu>li>.treeview-menu {
        margin: 0 1px;
        background: #2c3b41;
    }

    .sidebar-menu>li .label,
    .sidebar-menu>li .badge {
        margin-top: 3px;
        margin-right: 5px;
    }

    .sidebar-menu li.header {
        padding: 10px 25px 10px 15px;
        font-size: 12px;
        color: #4b646f;
        background: #1a2226;
    }

    .sidebar-menu li>a>.fa-angle-left {
        width: auto;
        height: auto;
        padding: 0;
        margin-right: 10px;
        margin-top: 3px;
    }

    .sidebar-menu li.active>a>.fa-angle-left {
        transform: rotate(-90deg);
    }

    .sidebar-menu li.active>.treeview-menu {
        display: block;
    }

    .sidebar-menu a {
        color: #b8c7ce;
        text-decoration: none;
    }

    .sidebar-menu .treeview-menu {
        display: none;
        list-style: none;
        padding: 0;
        margin: 0;
        padding-left: 5px;
    }

    .sidebar-menu .treeview-menu .treeview-menu {
        padding-left: 20px;
    }

    .sidebar-menu .treeview-menu>li {
        margin: 0;
    }

    .sidebar-menu .treeview-menu>li>a {
        padding: 5px 5px 5px 15px;
        display: block;
        font-size: 14px;
        color: #8aa4af;
    }

    .sidebar-menu .treeview-menu>li>a>.fa {
        width: 20px;
    }

    .sidebar-menu .treeview-menu>li>a>.fa-angle-left,
    .sidebar-menu .treeview-menu>li>a>.fa-angle-down {
        width: auto;
    }

    .sidebar-menu .treeview-menu>li.active>a,
    .sidebar-menu .treeview-menu>li>a:hover {
        color: #fff;
    }

    .order {
        margin-bottom: 0px !important;
    }
</style>



<section class="pl-lg-5">
    <ul class="sidebar-menu">
        <li class="header">MENU</li>
        <li class="treeview">
            <a href="<?php echo base_url('Dashboard') ?>">
                <i class="fa fa-th"></i><span>Dashboard</span>
            </a>
        </li>
        <li class="treeview">
            <a href="<?php echo base_url('Profile') ?>">
                <i class="fas fa-user-alt"></i>
                <span>Profile</span>
            </a>
        </li>
        <li class="treeview">
            <a href="<?php echo base_url('Wishlist') ?>">
            <i class="fas fa-heart"></i>
                <span>Wishlist</span>
            </a>
        </li>
        <li class="treeview">
            <a href="<?php echo base_url('Orders') ?>">
            <i class="fas fa-tasks"></i>
                <span>My Orders</span>
            </a>
        </li>
        <li class="treeview">
            <a href="<?php echo base_url('Orders/track_order') ?>">
            <i class="fas fa-tasks"></i>
                <span>Track Your Orders</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('Register/logout');  ?>">
            <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>

    </ul>
</section>