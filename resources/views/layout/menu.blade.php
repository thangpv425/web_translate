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

            {{-- Menu User --}}
            <li>
                <a href="/"><i class="fa fa-home fa-fw"></i> Home Page</a>
            </li>
            @if (Sentinel::check() && Sentinel::inRole('user'))
            <li>
                <a href="/user/history"><i class="fa fa-list-ul fa-fw"></i> Contribute history</a>
            </li>
            @endif
            
            {{-- Menu Admin --}}
            @if (Sentinel::check() && Sentinel::inRole('admin'))
                <li>
                    <a href="{{ route('keyword-list') }}"><i class="fa fa-list-ul fa-fw"></i> Keywords List</a>
                </li>
                <li>
                    <a href="{{ route('meaning-list') }}"><i class="fa fa-list-ul fa-fw"></i> Meanings List</a>
                </li>
                <li>
                    <a href="{{ route('keywordTempList') }}"><i class="fa fa-stack-exchange fa-fw"></i> Approval Keyword</a>
                </li>
                
                <li><a href="{{ route('meaningTempList') }}"><i class="fa fa-stack-exchange fa-fw"></i> Approval Meaning</a></li>
                <li>
                    <a href="{{ route('users-management') }}"><i class="fa fa-users fa-fw"></i> Users management</a>
                </li>
            @endif
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>