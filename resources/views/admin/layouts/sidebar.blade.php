<?php
$adminId = Session::get('adminId');
$admin = App\Models\Admin::where('id', $adminId)->first();
?>

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
        <li class="nav-item  {{ request()->is('admin/dashboard') ? 'menu-open' : '' }} ">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>


        <li
            class="nav-item
              {{ request()->is('admin/pending_enquiry') ? 'menu-open' : '' }}
              {{ request()->is('admin/enquiry') ? 'menu-open' : '' }}
          ">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Enquiry

                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item {{ request()->is('admin/pending_enquiry') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/pending_enquiry') }}"
                        class="nav-link {{ request()->is('admin/pending_enquiry') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pending</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/enquiry') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/enquiry') }}"
                        class="nav-link {{ request()->is('admin/enquiry') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Completed </p>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="nav-item
              {{ request()->is('admin/pending_contact_us') ? 'menu-open' : '' }}
              {{ request()->is('admin/contact_us') ? 'menu-open' : '' }}
          ">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Contact Message

                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item {{ request()->is('admin/pending_contact_us') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/pending_contact_us') }}"
                        class="nav-link {{ request()->is('admin/pending_contact_us') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pending</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/contact_us') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/contact_us') }}"
                        class="nav-link {{ request()->is('admin/contact_us') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Completed </p>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item">
            <a href="{{ route('category.index') }}"
                class="nav-link {{ request()->is('admin/category') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Website Category
                </p>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('technology.index') }}"
                class="nav-link {{ request()->is('admin/technology') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Technology
                </p>
            </a>
        </li>


        <li
            class="nav-item
          {{ request()->is('admin/service/create') ? 'menu-open' : '' }}
          {{ request()->is('admin/service') ? 'menu-open' : '' }}
      ">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Service

                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item {{ request()->is('admin/service/create') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/service/create') }}"
                        class="nav-link {{ request()->is('admin/service/create') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/service') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/service') }}"
                        class="nav-link {{ request()->is('admin/service') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Manage</p>
                    </a>
                </li>
            </ul>
        </li>




        <li class="nav-item">
            <a href="{{ route('work.index') }}" class="nav-link {{ request()->is('admin/work') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Work
                </p>
            </a>
        </li>


        {{-- <li class="nav-item">
        <a href="{{route('subcategory.index')}}" class="nav-link {{ (request()->is('admin/subcategory')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Sub category
          </p>
        </a>
      </li> --}}



        <li class="nav-item">
            <a href="{{ route('company.index') }}"
                class="nav-link {{ request()->is('admin/company') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Client
                </p>
            </a>
        </li>


        <li
            class="nav-item
          {{ request()->is('admin/project/create') ? 'menu-open' : '' }}
          {{ request()->is('admin/project') ? 'menu-open' : '' }}
      ">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Project
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item {{ request()->is('admin/project/create') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/project/create') }}"
                        class="nav-link {{ request()->is('admin/project/create') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/project') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/project') }}"
                        class="nav-link {{ request()->is('admin/project') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Manage</p>
                    </a>
                </li>
            </ul>
        </li>


        <hr>



        <p style="color: white;">Income / Expense</p>


        <li class="nav-item">
            <a href="{{ route('income_expense_category.index') }}"
                class="nav-link {{ request()->is('admin/income_expense_category') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Category
                </p>
            </a>
        </li>


        <li
            class="nav-item
          {{ request()->is('admin/income_expense/create') ? 'menu-open' : '' }}
          {{ request()->is('admin/income_expense') ? 'menu-open' : '' }}
      ">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Income / Expense
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item {{ request()->is('admin/income_expense/create') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/income_expense/create') }}"
                        class="nav-link {{ request()->is('admin/income_expense/create') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/income_expense') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/income_expense') }}"
                        class="nav-link {{ request()->is('admin/income_expense') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Manage</p>
                    </a>
                </li>
            </ul>
        </li>



        <li class="nav-item  {{ request()->is('admin/all_transaction') ? 'menu-open' : '' }}">
            <a href="{{ route('all_transaction') }}"
                class="nav-link {{ request()->is('admin/all_transaction') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    All Transactions
                </p>
            </a>
        </li>


        <li class="nav-item  {{ request()->is('admin/ledger') ? 'menu-open' : '' }}">
            <a href="{{ route('ledger') }}" class="nav-link {{ request()->is('admin/ledger') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Ledger
                </p>
            </a>
        </li>





        <hr>



        @if ($admin->role_id == 1)
            <li
                class="nav-item
          {{ request()->is('admin/review/create') ? 'menu-open' : '' }}
          {{ request()->is('admin/review') ? 'menu-open' : '' }}
      ">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                        Review

                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item {{ request()->is('admin/review/create') ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/review/create') }}"
                            class="nav-link {{ request()->is('admin/review/create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('admin/review') ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/review') }}"
                            class="nav-link {{ request()->is('admin/review') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manage</p>
                        </a>
                    </li>
                </ul>
            </li>









            {{-- <li class="nav-item  {{ (request()->is('admin/role')) ? 'menu-open' : '' }}">
        <a href="{{URL::to('admin/role')}}" class="nav-link {{ (request()->is('admin/role')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Role
          </p>
        </a>
      </li> --}}


            <li class="nav-item  {{ request()->is('admin/admins') ? 'menu-open' : '' }}">
                <a href="{{ URL::to('admin/admins') }}"
                    class="nav-link {{ request()->is('admin/admins') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Admins
                    </p>
                </a>
            </li>








            <li
                class="nav-item
          {{ request()->is('admin/site-setting') ? 'menu-open' : '' }}
          {{ request()->is('admin/change-password') ? 'menu-open' : '' }}
      ">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                        Settings
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('site-setting') }}"
                            class="nav-link {{ request()->is('admin/site-setting') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Website Setting</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('change-password') }}"
                            class="nav-link {{ request()->is('admin/change-password') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file"></i>
                            <p>Change Password</p>
                        </a>
                    </li>
                </ul>
            </li>


            <br>
            <br>
        @endif


    </ul>
</nav>
