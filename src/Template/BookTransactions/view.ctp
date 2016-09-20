<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Book Transaction'), ['action' => 'edit', $bookTransaction->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Book Transaction'), ['action' => 'delete', $bookTransaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookTransaction->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Book Transactions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Book Transaction'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Books'), ['controller' => 'Books', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Book'), ['controller' => 'Books', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bookTransactions view large-9 medium-8 columns content">
    <h3><?= h($bookTransaction->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $bookTransaction->has('user') ? $this->Html->link($bookTransaction->user->name, ['controller' => 'Users', 'action' => 'view', $bookTransaction->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Book') ?></th>
            <td><?= $bookTransaction->has('book') ? $this->Html->link($bookTransaction->book->title, ['controller' => 'Books', 'action' => 'view', $bookTransaction->book->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($bookTransaction->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Issue Date') ?></th>
            <td><?= h($bookTransaction->issue_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Return Date') ?></th>
            <td><?= h($bookTransaction->return_date) ?></td>
        </tr>
    </table>
</div>
