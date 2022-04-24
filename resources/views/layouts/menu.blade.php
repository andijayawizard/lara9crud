<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('about') }}" class="nav-link {{ Request::is('about') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>About</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('posts.index') }}" class="nav-link {{ Request::is('posts') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Posts</p>
    </a>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-circle"></i>
        <p>
            Products
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('brands.index') }}" class="nav-link {{ Request::is('brands') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Brands</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('products.index') }}" class="nav-link {{ Request::is('products') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>Products</p>
            </a>
        </li>
    </ul>
</li>