<section class="content-header">
      <h1>
        Borrow <?= $book->title ?>
        <small>Please verify the details and generate a request for book.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Books</a></li>
        <li class="active">Borrow</li>
      </ol>
</section>

    <!-- Main content -->
<section class="content">
      <!-- Your Page Content Here -->
        <div class="col-md-3" style="width:100%">

          <!-- Book info -->
          <div class="box box-primary">
            <div class="box-body box-profile" style="width:100%">
              <?php if($book->photo != ""): ?>
                <a href="/files/books/photo/<?= $book->id?>/<?= $book->photo ?>" data-lightbox="image-1" data-title="<?php echo $book->photo ?>">
                    <img style="width:150px" class="profile-user-img img-responsive img-circle" src="/files/books/photo/<?= $book->id?>/thumbnail-<?= $book->photo ?>" alt="Book Picture">
                </a>
            <?php else: ?>
                <img style="width:150px" class="profile-user-img img-responsive img-circle" src="/files/noimage.jpg" alt="Book Picture">  
            <?php endif; ?>

              <h3 class="profile-username text-center"><?= $this->Html->link("$book->title",['controller' => 'Books', 'action' => 'view', $book->id]) ?></h3>

              <p class="text-muted text-center"><?= h($book->writer) ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Edition</b> <a class="pull-right"><?= h($book->edition) ?></a>
                </li>
                <li class="list-group-item">
                  <b>Course</b> <a class="pull-right"><?= h($book->course) ?></a>
                </li>
                <li class="list-group-item">
                  <b>Price</b> <a class="pull-right"><?= h($book->price) ?></a>
                </li>
                <li class="list-group-item">
                  <b>Owner</b> <a class="pull-right"><?= $this->Html->link($book->user->name, ['controller' => 'Users', 'action' => 'view', $book->user->id], ['class' => 'pull-right'])?></a>
                </li>
                <li class="list-group-item">
                  <b>Status</b> <a class="pull-right"><?php if($book->status == 0) echo "Available"; 
                    elseif($book->status == 1) echo "Requested"; 
                    elseif($book->status == 2) echo "Not Available"; 
                    ?></a>
                </li>
                <li class="list-group-item">
                <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Description
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body">
                      <?= $this->Text->autoParagraph(h($book->description)); ?>
                    </div>
                  </div>
                </div>
                </div>
                </li>
                <li class="list-group-item">
                    <?= $this->Form->create(null,['url' => "/books/generateRequest/$book->id", 'method' => 'POST']) ?>
                        <fieldset>
                            <legend><?= __('Select Weeks') ?></legend>
                            <?php
                                echo '<b>For how many weeks you want this book? </b>';
                                echo $this->Form->select('Weeks', [
                                    '0' => 'Select',
                                    '1' => '1 Week',
                                    '2' => '2 Week',
                                    '3' => '3 Week'
                                    ], 
                                    /* 3rd parameter used to specify attributes in select */
                                    [
                                    'disabled' => ['select'],
                                    'default' => ['select'],
                                    'class' => 'form-control'
                                    ]);
                            ?>
                        </fieldset>
                </li>
                <!-- Reviews -->
              </ul>
              </div>
              <div class="box-footer">
                <?php if($book->user_id != $user_id && $book->status == 0): ?>
                    <?= $this->Form->button(__('Generate Request'), ['class' => 'btn btn-primary btn-primary']) ?>
                        <?= $this->Form->end(); 
                    ?>
                    <a href="/books/search-book/" class="btn btn-primary btn-danger"><b>Cancel</b></a><br/>
                <?php endif; ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>     
</section>
    <!-- /.content -->
