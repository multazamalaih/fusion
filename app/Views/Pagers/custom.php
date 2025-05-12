<?php if ($pager->hasPreviousPage()): ?>
    <li class="page-item">
        <a class="page-link" href="<?= $pager->getPreviousPage() ?>">
            <i class="fas fa-chevron-left"></i>
        </a>
    </li>
<?php endif; ?>

<?php foreach ($pager->links() as $link): ?>
    <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
        <a class="page-link" href="<?= $link['uri'] ?>">
            <?= esc($link['title']) ?>
        </a>
    </li>
<?php endforeach; ?>

<?php if ($pager->hasNextPage()): ?>
    <li class="page-item">
        <a class="page-link" href="<?= $pager->getNextPage() ?>">
            <i class="fas fa-chevron-right"></i>
        </a>
    </li>
<?php endif; ?>