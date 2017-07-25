<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="/translate"><i class="fa fa-home fa-fw"></i>Home</a>
            </li>

            <li>
                <a href="user/view/{{Sentinel::check()->id}}"><i class="fa fa-male fa-fw"></i>Profile</a>
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>