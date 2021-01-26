<?php $pager->setSurroundCount(2) ?>

    <?php if ($pager->hasPreviousPage()) : ?>
            <a href="<?= $pager->getFirst() ?>" aria-label="First">
                <span aria-hidden="true">First</span>
            </a>
            <a href="<?= $pager->getPreviousPage() ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
            <a href="<?= $link['uri'] ?>" <?= $link['active'] ? 'class="active"' : '' ?>>
                <?= $link['title'] ?>
            </a>
    <?php endforeach ?>

    <?php if ($pager->hasNextPage()) : ?>
            <a href="<?= $pager->getNextPage() ?>" aria-label="Previous">
                <span aria-hidden="true">&raquo;</span>
            </a>
            <a href="<?= $pager->getLast() ?>" aria-label="Last">
                <span aria-hidden="true">Last</span>
            </a>
    <?php endif ?>