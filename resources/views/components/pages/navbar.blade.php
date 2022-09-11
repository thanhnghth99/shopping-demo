                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('public.home') }}" class="nav-item nav-link @if(View::getSection('title') == 'home') active @endif">Home</a>
                            <a href="{{ route('public.shop') }}" class="nav-item nav-link @if(View::getSection('title') == 'shop') active @endif">Shop</a>
                            <a href="{{ route('public.detail') }}" class="nav-item nav-link @if(View::getSection('title') == 'detail') active @endif">Shop Detail</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle @if(View::getSection('title') == 'cart' || View::getSection('title') == 'checkout') active @endif" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="{{ route('public.cart') }}" class="dropdown-item ">Shopping Cart</a>
                                    <a href="{{ route('public.checkout') }}" class="dropdown-item">Checkout</a>
                                </div>
                            </div>
                            <a href="{{ route('public.contact') }}" class="nav-item nav-link @if(View::getSection('title') == 'contact') active @endif">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            <a href="" class="nav-item nav-link">Login</a>
                            <a href="" class="nav-item nav-link">Register</a>
                        </div>
                    </div>
                </nav>