<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Add a review for the book'), ['controller' => 'Reviews', 'action' => 'add', $transaction->book->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Transaction'), ['action' => 'delete', $transaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transaction->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Transactions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Transaction'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Books'), ['controller' => 'Books', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Book'), ['controller' => 'Books', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Owners'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Owner'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="transactions view large-9 medium-8 columns content">
    <h3><?= __("Details for transaction id $transaction->id"); ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Book') ?></th>
            <td><?= $transaction->has('book') ? $this->Html->link($transaction->book->title, ['controller' => 'Books', 'action' => 'view', $transaction->book->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Owner') ?></th>
            <td><?= $transaction->has('owner') ? $this->Html->link($transaction->owner->name, ['controller' => 'Users', 'action' => 'view', $transaction->owner->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Borrower') ?></th>
            <td><?= $transaction->has('borrower') ? $this->Html->link($transaction->borrower->name, ['controller' => 'Users', 'action' => 'view', $transaction->borrower->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Random') ?></th>
            <td><?= h($transaction->random) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($transaction->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Request Id') ?></th>
            <td><?= $this->Number->format($transaction->request_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td>
                <?php 
                    if($transaction->status == 0) echo "Pending Code Verification"; 
                    if($transaction->status == 1) echo "Code Verified";
                    if($transaction->status == 2) echo "Return Requested";
                    if($transaction->status == 3) echo "Transaction Closed";
                ?>
            </td>
        </tr>
        <tr>
            <th><?= __('Issue Date') ?></th>
            <td><?= h($transaction->issue_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Return Date') ?></th>
            <td><?= h($transaction->return_date) ?></td>
        </tr>
    </table>
</div>
