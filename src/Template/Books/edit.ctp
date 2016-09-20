<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Book
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
            <h3 class="box-title"><?= __('Edit Book') ?></h3>
        </div>
        <?= $this->Form->create($book, ['type' => 'file']) ?>
        <div class="box-body">    
            <fieldset>
            <div class="form-group">
                <?php echo $this->Form->input('title', ['class' => 'form-control', 'placeholder' => 'Enter Book Title']);?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('writer', ['class' => 'form-control', 'placeholder' => 'Enter Book Writer']);?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('edition', ['class' => 'form-control', 'placeholder' => 'Enter Book Edition']);?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('course', ['class' => 'form-control', 'placeholder' => 'Enter Book Course']);?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('description', ['class' => 'form-control', 'placeholder' => 'Enter Book Description', 'type' => 'textarea']);?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('price', ['class' => 'form-control', 'placeholder' => 'Enter Book Price', 'type' => 'float']);?>
            </div>
            <div class="form-group">
                <legend>Edit Photo</legend>
                <?php if($book->photo != ""): ?>
                    <a href="/files/books/photo/<?= $book->id?>/<?= $book->photo ?>" data-lightbox="image-1" data-title="<?php echo $book->photo ?>">
                    <img style="width:150px" class="profile-user-img img-responsive img-circle" src="/files/books/photo/<?= $book->id?>/thumbnail-<?= $book->photo ?>" alt="Book Picture">
                </a>
                <?php else: ?>
                    
                    <img style="width:150px" class="profile-user-img img-responsive img-circle" src="/files/addimage.jpg" alt="Book Picture">
                    
                <?php endif; ?>
                <?php echo $this->Form->input('photo', ['type' => 'file']);?>
            </div>
            <div class="box-footer">
                <?php echo $this->Form->button('Submit', ['class' => 'btn btn-primary']);?>
                <?= $this->Html->link(__('Delete Book'), ['action' => 'delete', $book->id], ['confirm' => __('Are you sure you want to delete this book # {0}?', $book->id), 'class' => 'btn btn-primary btn-danger']) ?>
            </div>
    
        <?= $this->Form->end() ?>
        </div>
    </div>
    </section>
    <!-- /.content -->
