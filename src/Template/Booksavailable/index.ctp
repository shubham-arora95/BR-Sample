<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Booksavailable'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="booksavailable index large-9 medium-8 columns content">
    <h3><?= __('Booksavailable') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('writer') ?></th>
                <th><?= $this->Paginator->sort('edition') ?></th>
                <th><?= $this->Paginator->sort('course') ?></th>
                <th><?= $this->Paginator->sort('price') ?></th>
                <th><?= $this->Paginator->sort('is_borrowed') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($booksavailable as $booksavailable): ?>
            <tr>
                <td><?= $this->Number->format($booksavailable->id) ?></td>
                <td><?= h($booksavailable->title) ?></td>
                <td><?= h($booksavailable->writer) ?></td>
                <td><?= h($booksavailable->edition) ?></td>
                <td><?= h($booksavailable->course) ?></td>
                <td><?= $this->Number->format($booksavailable->price) ?></td>
                <td><?= h($booksavailable->is_borrowed) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $booksavailable->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $booksavailable->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $booksavailable->id], ['confirm' => __('Are you sure you want to delete # {0}?', $booksavailable->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
