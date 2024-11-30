<?php function renderMenu($menus) { ?>
    <ul>
        <?php foreach ($menus as $menu): ?>
            <li <?= !empty($menu['children']) ? 'class="menu-item-has-children"' : '' ?> >
                <a href="<?= $menu['url'] ?: '#' ?>">
                    <?= esc($menu['menu_name']) ?>
                </a>
                <?php if (!empty($menu['children'])): ?>
                    <ul class="sub-menu">
                        <?= renderMenu($menu['children']); ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php } ?>

<div class="vs-menu-wrapper">
    <div class="vs-menu-area text-center">
        <button class="vs-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo">
            <a href="index.html"><img src="<?= base_url('themes/farmix/') ?>assets/img/logo.png" alt="Farmix"></a>
        </div>
        <div class="vs-mobile-menu">
            <?= renderMenu($topNav); ?>
        </div>
    </div>
</div>