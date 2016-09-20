<section class="content-header">
      <h1>
        Verify code for transaction id: <?= $transaction->id ?>
        <small>You can verify code for transaction on this page.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Transactions</a></li>
        <li class="active">Verify-Code</li>
      </ol>
</section>

    <!-- Main content -->
    <section class="content">
      <!-- Your Page Content Here -->
        <div class="row" style="position:relative">
        <div class="col-md-3" style="width:100%">

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
                    <b><?= __('Book') ?></b> <a class="pull-right"><?= $this->Html->link($transaction->book->title, ['controller' => 'Books', 'action' => 'view', $transaction->book->id], ['class' => "pull-right"]) ?></a>
                </li>

                <li class="list-group-item">
                    <b>Borrower</b> <a class="pull-right"><?= $this->Html->link($transaction->borrower->name, ['controller' => 'Users', 'action' => 'view', $transaction->borrower_id], ['class' => 'pull-right'])?></a>
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
                <?= $this->Form->create(null,['url' => "/transactions/checkEnteredCode/$transaction->id", 'method' => 'POST']) ?>
                <legend><?= __('Verify Code') ?></legend>
                <?php
            echo $this->Form->input('Enter verification code ( Case Sensitive)', ['type' => 'text', 'name' => 'enteredCode', 'id' => 'enteredCode', 'required' => 'true', 'class' => 'form-control']);
                ?><br/>
                 <?php echo $this->Form->button('Submit', ['class' => 'btn btn-primary']);?>
                <?= $this->Form->end() ?>
            </div>
            
        </div>
          <!-- /.box -->
        </div>
        </div>  
    </section>
    <!-- /.content -->
