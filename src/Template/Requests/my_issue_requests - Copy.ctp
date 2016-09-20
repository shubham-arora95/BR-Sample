<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Request'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Books'), ['controller' => 'Books', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Book'), ['controller' => 'Books', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Borrowers'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Borrower'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="requests index large-9 medium-8 columns content">
    <h3><?= __('Requests') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>  
                 <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('book_id') ?></th>
                <th><?= $this->Paginator->sort('borrower_id') ?></th>
               <!-- <th><?= $this->Paginator->sort('owner_id') ?></th> -->
                <th><?= $this->Paginator->sort('Weeks') ?></th>
                <th><?= $this->Paginator->sort('ownerAck','Status') ?></th>
                <th><?= $this->Paginator->sort('rentPaid') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $request): ?>
            <tr>
                <td><?= $this->Number->format($request->id) ?></td>
                <td><?= $request->has('book') ? $this->Html->link($request->book->title, ['controller' => 'Books', 'action' => 'view', $request->book->id]) : '' ?></td>
                <td><?= $request->has('borrower') ? $this->Html->link($request->borrower->name, ['controller' => 'Users', 'action' => 'view', $request->borrower->id]) : '' ?></td>
                <!-- <td><?= $request->has('owner') ? $this->Html->link($request->owner->name, ['controller' => 'Users', 'action' => 'view', $request->owner->id]) : '' ?></td> -->
                <td><?= $this->Number->format($request->Weeks) ?></td>
                <td><?php 
                        if($request->ownerAck == 0) echo 'Pending';
                        elseif($request->ownerAck == 1) echo 'Accepted';
                        elseif($request->ownerAck == 2) echo 'Declined';
                    ?>
                </td>
                <td><?= h($request->rentPaid)?'Yes':'No' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $request->id]) ?>
                    <?= $this->Html->link(__('  Accept'), ['action' => 'acceptIssueRequest', $request->id]) ?>
                    <?= $this->Form->postLink(__('  Decline'), ['action' => 'declineIssueRequest', $request->id], ['confirm' => __('Are you sure you want to decline this request for this book?', $request->id)]) ?>
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
