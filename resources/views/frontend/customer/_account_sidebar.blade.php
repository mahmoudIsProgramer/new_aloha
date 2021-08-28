<ul>
    <li><a href="{{ route('customer.profile') }}" class="active"> <i class="fa fa-user fa-lg"></i>
            Information</a>
    </li>
    <li><a href="02-profile-customer-orders.html"> <i class="fa fa-truck fa-lg"></i> My Orders</a>
    </li>
    <li><a href="03-profile-customer-returns.html"> <i class="fa fa-retweet fa-lg"></i> Returns </a>
    </li>
    <li><a href="{{ route('customer.change_password_view') }}"> <i class="fa fa-lock fa-lg"></i> Change
            Password </a>
    </li>
    <li>
        <a href="{{ route('customer.logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();"><i
                class="fa fa-sign-out fa-lg"></i></a>  
        <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
</ul>
