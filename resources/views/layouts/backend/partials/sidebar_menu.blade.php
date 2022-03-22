<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Page <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('page.create') }}">Create Page</a></li>
                    <li><a href="{{ route('page.index') }}">All Page</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-edit"></i> Slider <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('slider.create') }}">Create Slider</a></li>
                    <li><a href="{{ route('slider.index') }}">All Slider</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-edit"></i> Gallery <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('gallery.create') }}">Create Gallery</a></li>
                    <li><a href="{{ route('gallery.index') }}">All Gallery</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
