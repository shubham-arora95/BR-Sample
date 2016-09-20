<section class="content-header">
      <h1>
        My Added Books
        <small>This page shows all books added by you.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Books</a></li>
        <li class="active">My Added</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Your Page Content Here -->
        <div class="row" style="position:relative">
        <?php foreach ($books as $book): ?>
        <div class="col-md-3">

          <!-- Book info -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="/img/user4-128x128.jpg" alt="User profile picture">

              <h3 class="profile-username text-center"><?= $this->Html->link($book->title,['controller' => 'Books', 'action' => 'view', $book->id]) ?></h3>

              <p class="text-muted text-center"><?= h($book->writer) ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Book Id</b> <a class="pull-right"><?= h($book->id) ?></a>
                </li>
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
                  <b>Status</b> <a class="pull-right"><?php if($book->status == 0) echo "Available"; if($book->status == 1) echo "Not Available" ?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
            <!------ Box Footer -------------------------------------->
            <div class="box-footer">
                <?php if($book->user_id == $user_id): ?>
                    <?php if($book->status == 0): ?>
                        <div class="callout callout-info">
                            <h5>You can edit or add review for this book.</h5>    
                        </div>
                        <a class="btn btn-block btn-warning" href="/books/edit/<?php echo $book->id ?>">Edit Book</a>&nbsp;
                        <?= $this->Html->link(__('Add a Review'), ['controller' => 'reviews', 'action' => 'add', $book->id],['class' => 'btn btn-block btn-info']) ?>
                    <?php elseif($book->status != 0): ?>
                        <div class="callout callout-alert">
                            <h5>You can not edit or delete this book.</h5>    
                        </div>
                        <?= $this->Html->link(__('Add a Review'), ['controller' => 'reviews', 'action' => 'add', $book->id],['class' => 'btn btn-block btn-info']) ?>&nbsp;
                        <?= $this->Html->link(__('Request Return'), ['action' => 'requestReturn', $book->id],['class' => 'btn btn-block btn-primary']) ?>
                    <?php endif; ?>
                <?php endif ?>
            </div> 
          </div>
          <!-- /.box -->
        </div>
        <?php endforeach; ?>
        </div>  
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    </section>
    <!-- /.content -->

