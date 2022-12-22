<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="index.html">
            {{-- <img src="{{asset('images/logo.svg')}}" width="25" alt="Aero"> --}}
            <span class="m-l-10">Sahaba Food </span></a>
    </div>
    <div class="menu">
        <ul class="list">
            {{-- <li>
                <div class="user-info">
                    <a class="image" href="profile.html"><img src="{{asset('images/profile_av.jpg')}}" alt="User"></a>
                    <div class="detail">
                        <h4>Michael</h4>
                        <small>Super Admin</small>                        
                    </div>
                </div>
            </li> --}}
            <li><a href="/admin/home"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
            <li><a href="/admin/reports"><i class="zmdi zmdi-home"></i><span>Reports</span></a></li>


            <li><a href="/admin/orders"><i class="zmdi zmdi-swap-alt"></i><span>Orders</span> <span class="badge badge-info">{{$torders}} new</span></a></li>
            <li><a href="/admin/invoice_list"><i class="zmdi zmdi-swap-alt"></i><span>Invoices</span> <span class="badge badge-info"></span></a></li>


            <li class=""><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-store"></i><span>Store Setup</span></a>
                <ul class="ml-menu">
                    <li><a href="/admin/create_brand">Create Brand</a></li>
                    <li><a href="/admin/brand_list">Brand List</a></li>

                    <li><a href="/admin/create_size">Create Size </a></li>
                    <li><a href="/admin/size_list">Size List</a></li>

                    <li><a href="/admin/create_color">Create Color </a></li>
                    <li><a href="/admin/color_list">Color List</a></li>

                    <li><a href="/admin/create_unit">Create Unit </a></li>
                    <li><a href="/admin/unit_list">Unit List</a></li>

                    
                    <li><a href="/admin/create_tag">Create Tag </a></li>
                    <li><a href="/admin/tag_list">Tag List</a></li>
                </ul>
            </li>


            <li class=""><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-device-hub"></i><span>Create Category</span></a>
                <ul class="ml-menu">
                    <li><a href="/admin/create_cat">Create Main Category</a></li>
                    <li><a href="/admin/cat_list">Main Category List</a></li>

                    <li><a href="/admin/create_sub_cat">Create Sub Category</a></li>
                    <li><a href="/admin/sub_cat_list">Sub Category List</a></li>

                    <li><a href="/admin/create_sub_sub_cat">Create Sub > Sub Category</a></li>
                    <li><a href="/admin/sub_sub_cat_list">Sub > Sub Category List</a></li>
                </ul>
            </li>



            <li class=""><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-collection-item"></i><span>Products</span></a>
                <ul class="ml-menu">
                    <li><a href="/admin/upload">Upload Product</a></li>
                    <li><a href="/admin/product_list">Product List</a></li>
                </ul>
            </li>


            <li class=""><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-collection-item"></i><span>Local (Khuchra)</span></a>
                <ul class="ml-menu">
                    <li><a href="/admin/local_sell_page">Local Sell </a></li>
                    <li><a href="/admin/product_list">Local Product stock</a></li>
                </ul>
            </li>



            <li class=""><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-accounts"></i><span>Admin</span></a>
                <ul class="ml-menu">
                 <li><a href="/admin/create_admin_page">Add Admin</a></li>
                    <li><a href="/admin/admin_list">Admin List</a></li>
                </ul>
            </li>

            <li class=""><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-sun"></i><span>Users</span></a>
                <ul class="ml-menu">
                 <li><a href="/admin/user_list">All Users</a> </li>

                </ul>
            </li>

            <li class=""><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-sun"></i><span>Decoration</span></a>
                <ul class="ml-menu">
                 <li><a href="/admin/info_list/"> Edit Basic Infos</a></li>
                 <li><a href="/admin/edit_social">Edit Social Info</a></li>
                 <li><a href="/admin/create_banner"> Create Main Banner</a></li>
                 <li><a href="/admin/banner_list"> Main Banner List</a></li>
                 <li><a href="/admin/create_sub_banner"> Create Sub Banner</a></li>
                 <li><a href="/admin/sub_banner_list"> Sub Banner List</a></li>

                </ul>
            </li>

            <li class=""><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-sun"></i><span>Special Offer</span></a>
                <ul class="ml-menu">
                    <li><a href="/admin/edit_special_offer"> Add /Edit Special Offer</a></li>
                </ul>
            </li>

            <li class=""><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-sun"></i><span>Footer</span></a>
                <ul class="ml-menu">
                 <li><a href="/admin/edit_social">Edit Social Info</a></li>
                 <li><a href="/admin/create_link">Add Useful Links</a></li>
                 <li><a href="/admin/link_list"> Useful Links List</a></li>

                </ul>
            </li>

            
            <li class=""><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-sun"></i><span>Payment</span></a>
                <ul class="ml-menu">
                 <li><a href="/admin/create_payment_page">Create Payment Methods</a></li>
                 <li><a href="/admin/method_list">Methods List</a></li>
                </ul>
            </li>

            <li class=""><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-sun"></i><span>Requets</span></a>
                <ul class="ml-menu">
                 <li><a href="/admin/reloader_list">Reloader</a> <span class="badge badge-primary"></span></li>
                 <li><a href="/admin/withdraw_list">Withdraw</a><span class="badge badge-primary"></span></li>
                 <li><a href="/admin/admin_withdraw">Admin Withdraw</a><span class="badge badge-primary"></span></li>
                </ul>
            </li>


            

            <li class=""><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-sun"></i><span>Policies</span></a>
                <ul class="ml-menu">
                 <li><a href="/admin/toc">TOC</a> <span class="badge badge-primary"></span></li>
                 <li><a href="/admin/privacy_policy">Privacy Policy</a><span class="badge badge-primary"></span></li>
                 <li><a href="/admin/return_policy">Retun Policy</a><span class="badge badge-primary"></span></li>
                </ul>
            </li>
            
            <li class=""><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-sun"></i><span>Defaults</span></a>
                <ul class="ml-menu">
                 <li><a href="/admin/default_ref">Default Ref</a> <span class="badge badge-primary"></span></li>
                </ul>
            </li>

        </ul>
    </div>
</aside>