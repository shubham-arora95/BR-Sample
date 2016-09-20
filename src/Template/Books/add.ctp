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
            <h3 class="box-title"><?= __('Add Book') ?></h3>
        </div>
        <?= $this->Form->create($book) ?>
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
                <?php echo $this->Form->input('price', ['class' => 'form-control', 'placeholder' => 'Enter Book Price', 'type' => 'number']);?>
            </div>
            <!-- <div class="form-group">
                <?php echo $this->Form->input('photo', ['type' => 'file']);?>
            </div> -->
            <div class="box-footer">
                <?php echo $this->Form->button('Submit', ['class' => 'btn btn-primary']);?>
            </div>
                <!-- <?php
                    echo $this->Form->input('title');
                    echo $this->Form->input('writer');
                    echo $this->Form->input('edition');
                    echo $this->Form->input('course');
                    echo $this->Form->input('description');
                    echo $this->Form->input('price');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?> -->
        <?= $this->Form->end() ?>
        </div>
    </div>
    </section>
    <!-- /.content -->
