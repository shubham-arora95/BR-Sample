<section class="content-header">
      <h1>
        Edit Your Profile
        <small>Edit the details you want to change.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/books"><i class="fa fa-dashboard"></i>Books</a></li>
        <li class="active">Edit</li>
      </ol>
</section>

    <!-- Main content -->
<section class="content">
<!-- Your Page Content Here -->
    <div class="box box-primary">
        <div class="box-header with-border">
        </div>
        <?= $this->Form->create($user, ['type' => 'file']) ?>
        <div class="box-body">    
            <fieldset>
            <div class="form-group">
                <?php echo $this->Form->input('name', ['class' => 'form-control', 'placeholder' => 'Enter Book Title']);?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('email', ['class' => 'form-control', 'placeholder' => 'Enter Book Writer', 'type' => 'email']);?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('phone', ['class' => 'form-control', 'placeholder' => 'Enter Book Course', 'type' => 'number']);?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('address', ['class' => 'form-control', 'placeholder' => 'Enter Book Description', 'type' => 'textarea']);?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('photo', ['type' => 'file', 'required' => 'false']);?>
            </div>
            <div class="box-footer">
                <?php echo $this->Form->button('Submit', ['class' => 'btn btn-primary']);?>
            </div>
        <?= $this->Form->end() ?>
        </div>
    </div>
</section>



<!----------------------------------------------------------------------->
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Book Transactions'), ['controller' => 'BookTransactions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Book Transaction'), ['controller' => 'BookTransactions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Books'), ['controller' => 'Books', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Book'), ['controller' => 'Books', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reviews'), ['controller' => 'Reviews', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Review'), ['controller' => 'Reviews', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('phone');
            echo $this->Form->input('address');
            echo $this->Form->input('photo', ['type' => 'file', 'required' => 'false']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
