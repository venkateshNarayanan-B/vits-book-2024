<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?= base_url("assets/dist/img/AdminLTELogo.png") ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Vits Book</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url("assets/dist/img/user2-160x160.jpg") ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php if (has_permission('manage user')): ?>     
          <li class="nav-item <?= isset($menu) && $menu == 'user' ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?= isset($menu) && $menu == 'user' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manage Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
            <?php if (has_permission('user list')): ?>
              <li class="nav-item">
                <a href="<?= site_url("user/") ?>" class="nav-link <?= $title == 'User List'||$title == 'Create User'||$title == 'Edit User' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User List</p>
                </a>
              </li>
              <?php endif; ?>
              
              <li class="nav-item">
                <a href="<?= site_url("roles/") ?>" class="nav-link <?= $title == 'Roles List'||$title == 'Create Role'||$title == 'Edit Role' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Role List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url("permissions/") ?>" class="nav-link <?= $title == 'Permissions List'||$title == 'Create Permission'||$title == 'Edit Permission' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permission List</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>
          <!--Accounts section start-->
          <li class="nav-item <?= isset($menu) && $menu == 'accounts' ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?= isset($menu) && $menu == 'accounts' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Manage Accounts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url("accounts/groups") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Group List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url("accounts/ledgers") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ledger List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url("vouchers/") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Voucher List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url("categories") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Item Categories List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url("inventory/items") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Item List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url("inventory/transactions") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inventory List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url("services") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Services List</p>
                </a>
              </li>
            </ul>
          </li>
          <!--Accounts section end-->
          <!--CMS section start-->
          <li class="nav-item <?= isset($menu) && $menu == 'cms' ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?= isset($menu) && $menu == 'cms' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Manage CMS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url("cms/settings") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Settings</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="<?= site_url("cms/pages") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pages List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url("cms/products/categories") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products Category List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url("cms/products") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url("cms/enquiries") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products Enquiries</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url("cms/menus") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url("cms/content-blocks") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Content Blocks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url("cms/media-manager") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Media</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url("cms/sliders") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Slides</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url("cms/faq") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>FAQ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url("cms/testimonials") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Testimonials</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url("cms/themes") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Themes</p>
                </a>
              </li>
            </ul>
          </li>
          <!--CMS section end-->
          <!--Table section start-->
          
          <!--Table section end-->
          <!--Chart section start-->
          
          <!--Chart section end-->
          <!--Form section start-->
          
          <!--Form section end-->
          <?php if (has_permission('sample test')): ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <?php endif; ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>