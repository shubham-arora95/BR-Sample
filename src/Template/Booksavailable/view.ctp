<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Booksavailable'), ['action' => 'edit', $booksavailable->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Booksavailable'), ['action' => 'delete', $booksavailable->id], ['confirm' => __('Are you sure you want to delete # {0}?', $booksavailable->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Booksavailable'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Booksavailable'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="booksavailable view large-9 medium-8 columns content">
    <h3><?= h($booksavailable->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($booksavailable->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Writer') ?></th>
            <td><?= h($booksavailable->writer) ?></td>
        </tr>
        <tr>
            <th><?= __('Edition') ?></th>
            <td><?= h($booksavailable->edition) ?></td>
        </tr>
        <tr>
            <th><?= __('Course') ?></th>
            <td><?= h($booksavailable->course) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($booksavailable->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Price') ?></th>
            <td><?= $this->Number->format($booksavailable->price) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Borrowed') ?></th>
            <td><?= $booksavailable->is_borrowed ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($booksavailable->description)); ?>
    </div>
</div>
