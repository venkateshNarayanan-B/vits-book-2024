<header>
    <div class="logo">
        <a href="<?= base_url(); ?>">
            IDPCD
        </a>
    </div>

    <?php function renderMenu($menus) { ?>
        <ul class="navbar-nav">
            <?php foreach ($menus as $menu): ?>
                <li class="nav-item <?= !empty($menu['children']) ? 'dropdown' : '' ?>">
                    <a class="nav-link <?= !empty($menu['children']) ? 'dropdown-toggle' : '' ?>" 
                    href="<?= $menu['url'] ?: '#' ?>" 
                    <?= !empty($menu['children']) ? 'data-toggle="dropdown"' : '' ?>>
                        <?= esc($menu['menu_name']) ?>
                    </a>
                    <?php if (!empty($menu['children'])): ?>
                        <ul class="dropdown-menu">
                            <?= renderMenu($menu['children']); ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php } ?>

    <!-- Call this function in your header -->
    <?= renderMenu($topNav); ?>

    
</header>