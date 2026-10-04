<nav class="woocommerce-MyAccount-navigation">
    <ul>
        <li class="{{ (request()->is('client/dashboard')) ? 'is-active' : '' }}">
            <a href="{{ route('client.dashboard') }}">Dashboard</a>
        </li>
        <li class="{{ (request()->is('client/projects')) ? 'is-active' : '' }}">
            <a href="{{ route('client.projects') }}">Your Projects</a>
        </li>
       
        <li class="{{ (request()->is('client/account-details')) ? 'is-active' : '' }}">
            <a href="{{ route('client.account-details') }}">Account details</a>
        </li>
        <li>
            <a href="{{ route('client.logout') }}">Logout</a>
        </li>
    </ul>
</nav>