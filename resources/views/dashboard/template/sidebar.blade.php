<div class="app-sidebar__overlay " data-toggle="sidebar"></div>
<aside class="app-sidebar ">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ auth()->user() ? url('storage/avatar'). '/' . auth()->user()->avatar  : ''}}" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ auth()->user() ? auth()->user()->name : '' }}</p>
            <p class="app-sidebar__user-designation">{{ auth()->user() ? auth()->user()->role : '' }}</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item" href="{{ url('admin') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Books</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{ url('admin/books') }}"><i class="icon fa fa-circle-o"></i> View Books</a></li>
                <li><a class="treeview-item" href="{{ url('admin/books/add') }}"><i class="icon fa fa-circle-o"></i> New Book</a></li>
            </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-save"></i><span class="app-menu__label">Media</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{ url('admin/media') }}"><i class="icon fa fa-circle-o"></i> View Medias</a></li>
                <li><a class="treeview-item" href="{{ url('admin/media/add') }}"><i class="icon fa fa-circle-o"></i> New Media</a></li>
            </ul>
        </li>
        <li><a class="app-menu__item " href="{{ url('admin/faqs') }}"><i class="app-menu__icon fa fa-question-circle"></i><span class="app-menu__label">Faqs</span></a></li>
        
        
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-exchange"></i><span class="app-menu__label">Transactions</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{ url('admin/transactions') }}"><i class="icon fa fa-circle-o"></i> View Transactions</a></li>
                <li><a class="treeview-item" href="{{ url('admin/transactions/member') }}"><i class="icon fa fa-circle-o"></i> Member</a></li>
                <li><a class="treeview-item" href="{{ url('admin/transactions/new') }}"><i class="icon fa fa-circle-o"></i> New Transaction</a></li>
            </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Members</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{ url('admin/students') }}"><i class="icon fa fa-circle-o"></i> Students</a></li>
                <li><a class="treeview-item" href="{{ url('admin/faculties') }}"><i class="icon fa fa-circle-o"></i> Faculties</a></li>
            </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-bell"></i><span class="app-menu__label">Notice</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{ url('admin/notices') }}"><i class="icon fa fa-circle-o"></i> View Notice</a></li>
                <li><a class="treeview-item" href="{{ url('admin/notices/new') }}"><i class="icon fa fa-circle-o"></i> New Notice</a></li>
            </ul>
        </li> 
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">Settings</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{ url('admin/settings/about') }}"><i class="icon fa fa-circle-o"></i> About</a></li>
                <li><a class="treeview-item" href="{{ url('admin/librarians') }}"><i class="icon fa fa-circle-o"></i> Librarians</a></li>
                <li><a class="treeview-item" href="{{ url('admin/librarians/add') }}"><i class="icon fa fa-circle-o"></i> Add Librarians</a></li>
            </ul>
        </li>
        @if (auth()->user()->role == 'admin')
            <li><a class="app-menu__item " href="{{ url('admin/users') }}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Users</span></a></li>
        @endif
    </ul>
</aside>