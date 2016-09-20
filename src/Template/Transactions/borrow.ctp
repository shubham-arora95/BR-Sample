<section class="content-header">
      <h1>
        Borrow Transactions
        <small>This page shows your all borrow transactions.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Transactions</a></li>
        <li class="active">Borrow</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if($transactions->count()): ?>
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

              <p class="text-muted text-center"><?php echo"Transaction id - " .$transaction->id ?></p>

              <ul class="list-group list-group-unbordered">

                <li class="list-group-item">
                    <b>Request id</b> <a class="pull-right"><?= $transaction->request_id ?></a>
                </li>
                
                <li class="list-group-item">
                    <b><?= __('Book') ?></b> <a class="pull-right"><?= $this->Html->link($transaction->book->title, ['controller' => 'Books', 'action' => 'view', $transaction->book->id], ['class' => "pull-right"]) ?></a>
                </li>

                <li class="list-group-item">
                    <b>Owner</b> <a class="pull-right"><?= $this->Html->link($transaction->owner->name, ['controller' => 'Users', 'action' => 'view', $transaction->owner_id], ['class' => 'pull-right'])?></a>
                </li>

                <li class="list-group-item">
                    <b>Borrower</b> <a class="pull-right"><?= $this->Html->link($transaction->borrower->name, ['controller' => 'Users', 'action' => 'view', $transaction->borrower_id], ['class' => 'pull-right'])?></a>
                </li>

                <li class="list-group-item">
                    <b>Unique Code</b> <a class="pull-right"><?= $transaction->random ?></a>
                </li>

                <li class="list-group-item">
                    <b>Status</b> 
                    <a class="pull-right">
                    <?php 
                        if($transaction->status == 0) echo "Pending Code Verification"; 
                        if($transaction->status == 1) echo "Code Verified";
                        if($transaction->status == 2) echo "Return Requested";
                        if($transaction->status == 3) echo "Transaction Closed";
                    ?>
                    </a>
                </li>

                <li class="list-group-item">
                    <b>Issue Date</b> <a class="pull-right"><?= $transaction->issue_date ?></a>
                </li>

                <li class="list-group-item">
                    <b>Return Date</b> <a class="pull-right"><?= $transaction->return_date ?></a>
                </li>
              </ul>
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
                   <?= $this->Html->link(__('Return Book'), ['action' => 'returnBook', $transaction->id], ['class' => 'btn btn-block btn-primary']) ?>
                
                <?php elseif($transaction->status == 2): ?>
                    <div class="callout callout-warning">
                        <h5>You can now drop the book to owner.</h5>
                    </div>
                    <a class="btn btn-block">Ask the owner to confirm the return.</a>
                    
                <?php elseif($transaction->status == 3): ?>
                    <div class="callout callout-success" style="height:50%">
                        <h5>You have returned this book successfully.</h5>
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
         <?php else: echo "Oops! It seems like there is nothing to show you here."; endif;?>
    </section>
    <!-- /.content -->