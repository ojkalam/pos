<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('backend/dist/img/user.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ \Auth::user()->name }}</p>
          <span>{{ auth()->user()->role }}</span>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
     <!--  <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ Route::currentRouteName() == 'admin.dashboard'  ? 'active' : '' }}" >
          <a href="{{ route('admin.dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <!-- sales -->
       <!--  <li class="treeview">
          <a href="#">
            <i class="fa fa-sellsy" aria-hidden="true"></i>
            <span>Sales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li class=""><a href="{{ route('test') }}"><i class="fa fa-list"></i> testitem</a></li>              
          </ul> 
        </li> -->

<!-- contacts -->
     <li class="treeview @if(Request::is('admin/contacts*') )
              {{ 'active' }}
              @else
              {{ '' }}
              @endif
        ">
          <a href="#">
             <i class="fa fa-address-book"></i>
            <span>Contacts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li class=""><a href="{{ action('Admin\ContactController@index', ['type' => 'customer']) }}"><i class="fa fa-star"></i></i> Customer</a></li> 
               @if(auth()->user()->role == 'admin')             
              <li class=""><a href="{{ action('Admin\ContactController@index', ['type' => 'supplier']) }}"><i class="fa fa-star"></i></i> Supplier</a></li>              
              <!-- <li class=""><a href="{{ route('test') }}"><i class="fa fa-star"></i></i> Cashier</a></li>               -->
              @endif
          </ul> 
        </li>
<!-- sales -->
        <li class="treeview
          @if(Request::is('admin/sells*') )
              {{ 'active' }}
              @else
              {{ '' }}
              @endif
        ">
          <a href="#">
            <i class="fa fa-sellsy" aria-hidden="true"></i>
            <span>Sales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li class=""><a href="{{ route('sells.create') }}"><i class="fa fa-ship" aria-hidden="true"></i> Process Sale</a></li>
              <li class=""><a href="{{ route('sells.index') }}"><i class="fa fa-history" aria-hidden="true"></i> Sales History</a></li>
              
          </ul> 
        </li>

        <!-- <li><a href="{{ route('test') }}"><i class="fa fa-slack" aria-hidden="true"></i> <span>Cash Register</span></a></li> -->
<!-- Products -->
         @if(auth()->user()->role == 'admin')
         <li class="treeview
              @if(Request::is('admin/products*') || Request::is('admin/categories*') || Request::is('admin/brand*') || Request::is('admin/taxes*') )
              {{ 'active' }}
              @else
              {{ '' }}
              @endif
         ">
          <a href="#">
            <i class="fa fa-product-hunt" aria-hidden="true"></i>
            <span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li class=""><a href="{{ route('products.index') }}"><i class="fa fa-list"></i> List Products</a></li>
              <li class=""><a href="{{ route('products.create') }}"><i class="fa fa-plus-circle"></i> Add Product</a></li>
              <li class=""><a href="{{ route('categories.index') }}"><i class="fa fa-barcode"></i> Product Category</a></li>
              <li class=""><a href="{{ route('brands.index') }}"><i class="fa fa-bandcamp" aria-hidden="true"></i> Brand</a></li>
              <li class=""><a href="{{ route('taxes.index') }}"><i class="fa fa-bandcamp" aria-hidden="true"></i> Tax Rate
              <li class=""><a href="{{ route('discountoffers.index') }}"><i class="fa fa-money" aria-hidden="true"></i> Discount Offer</a></li> 
              
          </ul> 
      
        </li>
        <li class=""><a href="{{ route('purchases.index') }}"><i class="fa fa-money" aria-hidden="true"></i> Purchase</a></li> 
        <!-- new features -->
        <!-- {{ Route::currentRouteName() == 'admin.dashboard'  ? 'active' : '' }} -->
        <li class="@if(Request::is('admin/purchases*') )
              {{ 'active' }}
              @else
              {{ '' }}
              @endif
        " >
          <a href="{{ route('saletargets.index') }}">
            <i class="fa fa-line-chart" aria-hidden="true"></i> <span>Sales Target</span>
          </a>
        </li>

         <li class="treeview
          @if(Request::is('admin/report*') )
              {{ 'active' }}
              @else
              {{ '' }}
              @endif
        ">
          <a href="#">
            <i class="fa fa-bar-chart" aria-hidden="true"></i>
            <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li class=""><a href="{{ route('report.salesreport') }}"><i class="fa fa-star" aria-hidden="true"></i> Sales report</a></li>
              <li class=""><a href="{{ route('report.customersalesreport') }}"><i class="fa fa-star" aria-hidden="true"></i> Customer sales report</a></li>
              
          </ul> 
        </li>
        <li class=""><a href="{{ route('users.index') }}"><i class="fa fa-user"></i> Users</a></li>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>