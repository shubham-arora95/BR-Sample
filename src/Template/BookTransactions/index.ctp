<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Book Transaction'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Books'), ['controller' => 'Books', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Book'), ['controller' => 'Books', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bookTransactions index large-9 medium-8 columns content">
    <h3><?= __('Book Transactions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('book_id') ?></th>
                <th><?= $this->Paginator->sort('issue_date') ?></th>
                <th><?= $this->Paginator->sort('return_date') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookTransactions as $bookTransaction): ?>
            <tr>
                <td><?= $this->Number->format($bookTransaction->id) ?></td>
                <td><?= $bookTransaction->has('user') ? $this->Html->link($bookTransaction->user->name, ['controller' => 'Users', 'action' => 'view', $bookTransaction->user->id]) : '' ?></td>
                <td><?= $bookTransaction->has('book') ? $this->Html->link($bookTransaction->book->title, ['controller' => 'Books', 'action' => 'view', $bookTransaction->book->id]) : '' ?></td>
                <td><?= h($bookTransaction->issue_date) ?></td>
                <td><?= h($bookTransaction->return_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bookTransaction->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bookTransaction->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bookTransaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookTransaction->id)]) ?>
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
