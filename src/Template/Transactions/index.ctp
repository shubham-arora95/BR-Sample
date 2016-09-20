<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Transaction'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Books'), ['controller' => 'Books', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Book'), ['controller' => 'Books', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Owners'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Owner'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="transactions index large-9 medium-8 columns content">
    <h3><?= __('Issue Transactions') ?></h3>
    <?php if($issueTransactions->count()): ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('request_id') ?></th>
                <th><?= $this->Paginator->sort('book_id') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('borrower_id') ?></th>
                <th><?= $this->Paginator->sort('issue_date') ?></th>
                <th><?= $this->Paginator->sort('return_date') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($issueTransactions as $transaction): ?>
            <tr>
                <td><?= $this->Number->format($transaction->id) ?></td>
                <td><?= $this->Html->link($transaction->request_id,['controller' => 'Requests', 'action' => 'view', $transaction->request_id]) ?></td>
                <td><?= $transaction->has('book') ? $this->Html->link($transaction->book->title, ['controller' => 'Books', 'action' => 'view', $transaction->book->id]) : '' ?></td>
                <td>
                    <?php 
                        if($transaction->status == 0) echo "Pending Code Verification"; 
                        if($transaction->status == 1) echo "Code Verified";
                        if($transaction->status == 2) echo "Return Requested";
                        if($transaction->status == 3) echo "Transaction Closed";
                    ?>
                </td>
                <td><?= $transaction->has('borrower') ? $this->Html->link($transaction->borrower->name, ['controller' => 'Users', 'action' => 'view', $transaction->borrower->id]) : '' ?></td>
                <td><?= h($transaction->issue_date) ?></td>
                <td><?= h($transaction->return_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $transaction->id]) ?>
                    <?php 
                        if($transaction->status == 0): 
                    ?>
                    <?= $this->Html->link(__(' | Verify Code'), ['action' => 'verifyCode', $transaction->id]) ?>
                    <?php endif; ?>
                    <?php 
                        if($transaction->status == 2) echo $this->Html->link(__(' | Confirm Return'), ['action' => 'confirmReturn', $transaction->id], ['confirm' => __('Are you sure have collected this book for transaction id # {0}?', $transaction->id)]);
                    ?>
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
    <?php else: echo "Oops! It seems like there is nothing to show here."; endif;?>
    <hr/>
        
    <h3><?= __('Borrow Transactions') ?></h3>
    <?php if($borrowTransactions->count()): ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('request_id') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('owner_id') ?></th>
                <th><?= $this->Paginator->sort('issue_date') ?></th>
                <th><?= $this->Paginator->sort('return_date') ?></th>
                <th><?= $this->Paginator->sort('random', 'Unique Code') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($borrowTransactions as $transaction): ?>
            <b><?php if($transaction->status == 0) echo "* Please ask the owner of book ".$transaction->book->title." to verify the unique code otherwise you will not be able to return this book. <br/> <br/>" ?></b>
            <tr>
                <td><?= $this->Number->format($transaction->id) ?></td>
                <td><?= $this->Html->link($transaction->request_id,['controller' => 'Requests', 'action' => 'view', $transaction->request_id]) ?></td>
                <td>
                    <?php 
                        if($transaction->status == 0) echo "Pending Code Verification"; 
                        if($transaction->status == 1) echo "Code Verified";
                        if($transaction->status == 2) echo "Return Requested";
                        if($transaction->status == 3) echo "Transaction Closed";
                    ?>
                </td>
                <td><?= $transaction->has('owner') ? $this->Html->link($transaction->owner->name, ['controller' => 'Users', 'action' => 'view', $transaction->owner->id]) : '' ?></td>
                <td><?= h($transaction->issue_date) ?></td>
                <td><?= h($transaction->return_date) ?></td>
                <td><?= h($transaction->random) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $transaction->id]) ?>
                    <?php 
                        if($transaction->status == 1)
                            echo $this->Html->link(__('Return Book'), ['action' => 'returnBook', $transaction->id], ['confirm' => __('Are you sure you want to return this book for transaction id # {0}?', $transaction->id)])
                    ?>
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
    <?php else: echo "Oops! It seems like there is nothing to show here."; endif;?>
</div>
