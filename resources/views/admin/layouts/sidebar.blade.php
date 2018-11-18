<!--/sidebar-menu-->
<div class="sidebar-menu">
    <header class="logo1">
        <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a>
    </header>
    <div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
    <div class="menu">
        <ul id="menu" >
            <li><a href="{{ url('/administrator') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span><div class="clearfix"></div></a></li>
            <li id="menu-academico" ><a href="{{ URL::to('administrator/newsletter') }}"><i class="fa fa-envelope nav_icon"></i><span>Newsletter</span><div class="clearfix"></div></a></li>
            <li><a href="{{ URL::to('administrator/banner') }}"><i class="fa fa-picture-o" aria-hidden="true"></i><span>Banners</span><div class="clearfix"></div></a></li>
            <li id="menu-academico" ><a href="charts.html"><i class="fa fa-bar-chart"></i><span>Report</span><div class="clearfix"></div></a></li>
            <li id="menu-academico" ><a href="{{ URL::to('administrator/banner') }}"><i class="fa fa-list-ul" aria-hidden="true"></i><span>Shop</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                <ul id="menu-academico-sub" >
                    <li id="menu-academico-avaliacoes" ><a href="{{ URL::to('administrator/order') }}">Order</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="{{ URL::to('administrator/banner') }}">Invoice</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="{{ URL::to('administrator/banner') }}">Manufacturer</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="{{ URL::to('administrator/banner') }}">Customers</a></li>
                </ul>
            </li>
            <li id="menu-academico" ><a href="#"><i class="fa fa-cogs" aria-hidden="true"></i><span>Catelog</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                <ul id="menu-academico-sub" >
                    <li id="menu-academico-avaliacoes" ><a href="{{ URL::to('administrator/product') }}">Products</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="{{ URL::to('administrator/product-category') }}">Categories</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="{{ URL::to('administrator/product-attr-group') }}">Attributes group</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="{{ URL::to('administrator/product-attr') }}">Attributes</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="{{ URL::to('administrator/product-review') }}">Review</a></li>
                </ul>
            </li>
            <li><a href="{{ URL::to('administrator/settings') }}"><i class="fa fa-cogs" aria-hidden="true"></i>  <span>Setting system</span><div class="clearfix"></div></a></li>
            <li><a href="{{ URL::to('administrator/media') }}"><i class="fa fa-cogs" aria-hidden="true"></i>  <span>Media</span><div class="clearfix"></div></a></li>
            <li><a href="{{ URL::to('administrator/banner') }}"><i class="fa fa-map-marker" aria-hidden="true"></i>  <span>Address</span><div class="clearfix"></div></a></li>
            <li id="menu-academico" ><a href="{{ URL::to('administrator/banner') }}"><i class="fa fa-file-text-o"></i>  <span>CMS</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                <ul id="menu-academico-sub" >
                    <li id="menu-academico-boletim" ><a href="{{ URL::to('administrator/page') }}">Pages</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="{{ URL::to('administrator/posts') }}">Post</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="{{ URL::to('administrator/posts-cat') }}">Post category</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="{{ URL::to('administrator/tag') }}">Tags</a></li>
                </ul>
            </li>
            <li id="menu-academico" ><a href="{{ URL::to('administrator/menus') }}"><i class="fa fa-file-text-o"></i>  <span>Menus</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                <ul id="menu-academico-sub" >
                    <li id="menu-academico-boletim" ><a href="{{ URL::to('administrator/menus') }}">Menus</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="{{ URL::to('administrator/menu-items') }}">Menu Items</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="{{ URL::to('administrator/menu-locations') }}">Menu Locations</a></li>
                </ul>
            </li>
            <li id="menu-academico" ><a href="{{ route('users.index') }}"><i class="fa fa-file-text-o"></i>  <span>Users</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                <ul id="menu-academico-sub" >
                    <li id="menu-academico-boletim" ><a href="{{ route('users.index') }}">Users</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="{{ route('permissions.index') }}">Permissions</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="{{ route('roles.index') }}">Roles</a></li>
                </ul>
            </li>
            <li><a href="{{ URL::to('administrator/comment') }}"><i class="fa fa-check-square-o nav_icon"></i><span>Comments</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
            </li>
        </ul>
    </div>
</div>