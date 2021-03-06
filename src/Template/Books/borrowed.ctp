<section class="content-header">
      <h1>
        Borrowed Books
        <small>This page shows all books which you have borrowed.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Books</a></li>
        <li class="active">Borrowed</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Your Page Content Here -->
        <div class="row" style="position:relative">
        <?php foreach ($transactions as $transaction): ?>
        <div class="col-md-3">

          <!-- Book info -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                <?php if($transaction->book->photo != ""): ?>
                <a href="/files/books/photo/<?= $transaction->book->id?>/<?= $transaction->book->photo ?>" data-lightbox="image-1" data-title="<?php echo $transaction->book->photo ?>">
                    <img style="width:150px" class="profile-user-img img-responsive img-circle" src="/files/books/photo/<?= $transaction->book->id?>/thumbnail-<?= $transaction->book->photo ?>" alt="Book Picture">
                </a>
            <?php else: ?>
                <img style="width:150px" class="profile-user-img img-responsive img-circle" src="/files/noimage.jpg" alt="Book Picture">  
            <?php endif; ?>

              <h3 class="profile-username text-center"><?= $this->Html->link($transaction->book->title,['controller' => 'Books', 'action' => 'view', $transaction->book_id]) ?></h3>

              <p class="text-muted text-center"><?= h($transaction->book->writer) ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Edition</b> <a class="pull-right"><?= h($transaction->book->edition) ?></a>
                </li>
                <li class="list-group-item">
                  <b>Course</b> <a class="pull-right"><?= h($transaction->book->course) ?></a>
                </li>
                <li class="list-group-item">
                  <b>Price</b> <a class="pull-right"><?= h($transaction->book->price) ?></a>
                </li>
                <li class="list-group-item">
                  <b>Owner</b> <a class="pull-right"><?= $this->Html->link($transaction->owner->name, ['controller' => 'Users', 'action' => 'view', $transaction->borrower->id], ['class' => 'pull-right'])?></a>
                </li>
              </ul>
              <?= $this->Html->link(__('Add a Review'), ['controller' => 'reviews', 'action' => 'add', $transaction->book->id],['class' => 'btn btn-block btn-info']) ?>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <?php if($transaction->status == 0): ?>
                    <div class="callout callout-warning">
                        <h6>The owner needs to verify code for this.</h6>
                    </div>
                    <?= $this->Html->link(__('Contact Owner'), ['controller' => 'users', 'action' => 'view', $transaction->owner_id], ['class' => 'btn btn-block btn-primary']) ?>
                    
                <?php elseif($transaction->status == 1): ?>
                    <div class="callout callout-info">
                        <h>The owner has verified code for this.</h5>
                    </div>
                   <?= $this->Html->link(__('Return Book'), ['controller' => 'transactions', 'action' => 'returnBook', $transaction->id], ['class' => 'btn btn-block btn-primary']) ?>
                
                <?php elseif($transaction->status == 2): ?>
                    <div class="callout callout-warning">
                        <h5>You can now drop the book to owner.</h5>
                    </div>
                    <a class="btn btn-block"> Ask the owner to confirm the return asap.</a>
                    
                <?php elseif($transaction->status == 3): ?>
                    <div class="callout callout-success">
                        <h5>You have returned this book.</h5>
                    </div>
                    <a class="btn btn-block"> This transaction is closed.</a>
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
