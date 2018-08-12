<link href="{{ asset('backend/css/menu.css') }}" rel="stylesheet" type="text/css" />
<aside class="main-sidebar">
    <section class="sidebar">
        @yield('mainMenu')
        <ul class="sidebar-menu">
            <li class="treeview actives">
                <a href="#">
                    <span class="ico ico_system">&nbsp;</span> <span class="tit">Hệ Thống</span>
                    <span class="arr pull-right" style="display: block;"></span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ request()->is('sysconfig*') ? 'active' : '' }}">
                        <a href="{{ url("/sysconfig") }}">
                            <span class="ico ico_config"></span> <span class="tit">Cấu hình</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('sysgroup*') ? 'active' : '' }}">
                        <a href="{{ url("/sysgroup") }}">
                            <span class="ico ico_group"></span> <span class="tit">Nhóm quyền</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('sysuser*') ? 'active' : '' }}">
                        <a href="{{ url("/sysuser") }}">
                            <span class="ico ico_user"></span> <span class="tit">Tài khoản</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ request()->is('report*') ? 'active' : '' }}">
                <a href="{{ url("/report") }}">
                    <span class="ico ico_pages"></span> <span class="tit">Báo cáo ngày</span>
                </a>
            </li>
            <li class="{{ request()->is('test*') ? 'active' : '' }}">
                <a href="{{ url("/test") }}">
                    <span class="ico ico_pages"></span> <span class="tit"><?php print_r(request()->path()); ?></span>
                </a>
            </li>  
            <li class="treeview">
                <a href="#">
                    <span class="ico ico_system">&nbsp;</span> <span class="tit">Sản phẩm</span>
                    <span class="arr pull-right" style="display: block;"></span>
                </a>
                <ul class="treeview-menu">                   
                    <li class="{{ request()->is('productcatalog*') ? 'active' : '' }}">
                        <a href="{{ url("/productcatalog") }}">
                            <span class="ico ico_group"></span> <span class="tit">Danh mục sản phẩm</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('product*') ? 'active' : '' }}">
                        <a href="{{ url("/product") }}">
                            <span class="ico ico_user"></span> <span class="tit">Sản phẩm</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
<script type="text/javascript">
    function treesidebar(menu) {
        var _this = this;
        var animationSpeed = 300;
        $(document).on('click', menu + ' li a', function (e) {
            //Get the clicked link and the next element
            var $this = $(this);
            var checkElement = $this.next();
            //Check if the next element is a menu and is visible
            if ((checkElement.is('.treeview-menu')) && (checkElement.is(':visible')) && (!$('body').hasClass('sidebar-collapse'))) {
                //Close the menu
                checkElement.slideUp(animationSpeed, function () {
                    checkElement.removeClass('menu-open');
                    //Fix the layout in case the sidebar stretches over the height of the window
                    //_this.layout.fix();
                });
                checkElement.parent("li").removeClass("active");
            }
            //If the menu is not visible
            else if ((checkElement.is('.treeview-menu')) && (!checkElement.is(':visible'))) {
                //Get the parent menu
                var parent = $this.parents('ul').first();
                //Close all open menus within the parent
                var ul = parent.find('ul:visible').slideUp(animationSpeed);
                //Remove the menu-open class from the parent
                ul.removeClass('menu-open');
                //Get the parent li
                var parent_li = $this.parent("li");
                //Open the target menu and add the menu-open class
                checkElement.slideDown(animationSpeed, function () {
                    //Add the class active to the parent li
                    checkElement.addClass('menu-open');
                    parent.find('li.active').removeClass('active');
                    parent_li.addClass('active');
                    //Fix the layout in case the sidebar stretches over the height of the window
                    //_this.layout.fix();
                });
            }
            //if this isn't a link, prevent the page from being redirected
            if (checkElement.is('.treeview-menu')) {
                e.preventDefault();
            }
        });
    }
    treesidebar(".sidebar");
</script>