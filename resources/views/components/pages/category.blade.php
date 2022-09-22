<div class="col-lg-3 d-none d-lg-block">
    <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
        <h6 class="m-0">Categories</h6>
        <i class="fa fa-angle-down text-dark"></i>
    </a>
    <nav class="collapse {{ $class }} navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
        <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
            @foreach($getCategory() as $category)
            <div class="nav-item dropdown">
                <a href="#" class="nav-link" data-toggle="dropdown">{{ $category->name }}<i class="fa fa-angle-down float-right mt-1"></i></a>
                <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                    @foreach($category->subcategories->sortBy('name') as $subCategory)
                    <a href="" class="dropdown-item">{{ $subCategory->name }}</a>
                    @endforeach
                </div>
            </div>
            @endforeach
            <!-- <a href="" class="nav-item nav-link">Shirts</a>
            <a href="" class="nav-item nav-link">Shoes</a> -->
        </div>
    </nav>
</div>