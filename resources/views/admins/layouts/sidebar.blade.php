<div class="sidebar">
    <a class="item {{ request()->routeIs('admins.home') ? 'active' : '' }}" href="{{ route('admins.home') }}">
        <img class="icon" src="/images/main/sidebar/dashboard.png" />
        <p class="text">Dashboard</p>
    </a>

    @haspermission('manage_products','admin')
        <a class="item {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route(name:'categories.index') }}">
            <img class="icon" src="/images/main/sidebar/category.png" />
            <p class="text">Categories</p>
        </a>
        <a class="item {{ request()->routeIs('manufacturers.*') ? 'active' : '' }}" href="{{ route(name:'manufacturers.index') }}">
            <img class="icon" src="/images/main/sidebar/brand.png" />
            <p class="text">Manufacturers</p>
        </a>
        <a class="item {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route(name:'products.index') }}">
            <img class="icon" src="/images/main/sidebar/product.png" />
            <p class="text">Products</p>
        </a>
    @endhaspermission

    @haspermission('manage_orders','admin')
        <a class="item {{ request()->routeIs('orders.*') ? 'active' : '' }}" href="{{ route(name:'orders.index') }}">
            <img class="icon" src="/images/main/sidebar/order.png" />
            <p class="text">Orders</p>
        </a>
    @endhaspermission

    @haspermission('manage_users','admin')
        <a class="item {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route(name:'users.index') }}">
            <img class="icon" src="/images/main/sidebar/admin.png" />
            <p class="text">Users</p>
        </a>
    @endhaspermission

    @haspermission('manage_customers','admin')
        <a class="item {{ request()->routeIs('customers.*') ? 'active' : '' }}" href="{{ route(name:'customers.index') }}">
            <img class="icon" src="/images/main/sidebar/customer.png" />
            <p class="text">Customers</p>
        </a>
    @endhaspermission

    @haspermission('manage_settings','admin')
        <a class="item {{ (request()->routeIs('admins.settings.*') || request()->routeIs('permissions.*') || request()->routeIs('roles.*') || request()->routeIs('payment_methods.*')) ? 'active' : '' }}" href="{{ route(name:'admins.settings.index') }}">
            <img class="icon" src="/images/main/sidebar/settings.png" />
            <p class="text">Settings</p>
        </a>
    @endhaspermission
</div>
