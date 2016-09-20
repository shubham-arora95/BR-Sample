<section class="content-header">
      <h1>
        <?= $book->title ?>
        <small>This page shows description and reviews of the book <?= $book->title ?>.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
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

              <h3 class="profile-username text-center"><?= $book->title ?></h3>

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
                <!-- Reviews -->
                <li class="list-group-item">
                <div class="box-group" id="accordionTwo">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordionTwo" href="#collapseReviews">
                        Related Reviews
                      </a>
                    </h4>
                  </div>
                  <div id="collapseReviews" class="panel-collapse collapse in">
                    <div class="box-body">
                        <?php foreach ($reviews as $reviewDom): ?>
                            <?= $this->Text->autoParagraph(h($reviewDom->review)); ?><br/>
                            <b><?= $this->Html->link("-".$reviewDom->user->name, ['controller' => 'Users', 'action' => 'view', $reviewDom->user_id], ['class' => 'pull-right'])?></b>
                            <hr/>
                        <?php endforeach; ?>
                    </div>
                  </div>
                </div>
                </div>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
              <div class="box-footer">
                <?php if($book->user_id == $user_id): ?>
                    <?php if($book->status == 0): ?>
                        <a href="/books/edit/<?php echo $book->id ?>" class="btn btn-primary btn-primary"><b>Edit Book</b></a>
                        <?= $this->Html->link(__('Delete Book'), ['action' => 'delete', $book->id], ['confirm' => __('Are you sure you want to delete # {0}?', $book->id), 'class' => 'btn btn-primary btn-danger']) ?>
                    <?php else: ?>
                        <div class="callout callout-warning">
                            <h5>You can not edit or delete this book.</h5>    
                        </div>
                    <?php endif; ?>
                <?php elseif($book->user_id != $user_id && $book->status ==0): ?>
                    <a href="/books/borrow/<?= $book->id ?>" class="btn btn-primary"><b>Borrow</b></a>
                <?php endif; ?>
              </div>
          </div>
          <!-- /.box -->
        </div>     
    </section>
    <!-- /.content -->
