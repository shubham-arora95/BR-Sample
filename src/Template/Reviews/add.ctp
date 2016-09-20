<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Share Book
        <small>Add a book to give it on rent.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/books"><i class="fa fa-dashboard"></i>Books</a></li>
        <li class="active">Share</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Your Page Content Here -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __('Add Review') ?></h3>
        </div>
        <?= $this->Form->create($review) ?>
        <div class="box-body">    
            <fieldset>
            <div class="form-group">
                <?php echo $this->Form->input('review', ['class' => 'form-control', 'placeholder' => 'Enter Book Review', 'required' => 'true']);?>
            </div>
            <div class="form-group">
                <?php if($showAllBooks) echo $this->Form->input('Select Book', ['options' => $books, 'class' => 'form-control', 'name' => 'book_id', 'id' => 'book_id', 'required' => 'true']);?>
            </div>
            <div class="box-footer">
                <?php echo $this->Form->button('Submit', ['class' => 'btn btn-primary']);?>
            </div>
        <?= $this->Form->end() ?>
        </div>
    </div>
    </section>
    <!-- /.content -->