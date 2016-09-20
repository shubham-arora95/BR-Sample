<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $booksavailable->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $booksavailable->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Booksavailable'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="booksavailable form large-9 medium-8 columns content">
    <?= $this->Form->create($booksavailable) ?>
    <fieldset>
        <legend><?= __('Edit Booksavailable') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('writer');
            echo $this->Form->input('edition');
            echo $this->Form->input('course');
            echo $this->Form->input('description');
            echo $this->Form->input('price');
            echo $this->Form->input('is_borrowed');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
