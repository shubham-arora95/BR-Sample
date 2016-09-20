<section class="content-header">
      <h1>
        All Requests
        <small>This page shows all issue and borrow requests.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Requests</a></li>
        <li class="active">All</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Your Page Content Here -->
        <h3>Issue Requests</h3>
        <?php if($issueRequests->count()): ?>
        <div class="row" style="position:relative">
        <?php foreach ($issueRequests as $request): ?>
        <div class="col-md-3">

          <!-- Book info -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <?php if($request->book->photo != ""): ?>
                <a href="/files/books/photo/<?= $request->book->photo?>/<?= $request->book->photo ?>" data-lightbox="image-1" data-title="<?php echo $request->book->photo ?>">
                    <img style="width:150px" class="profile-user-img img-responsive img-circle" src="/files/books/photo/<?= $request->book->photo?>/thumbnail-<?= $request->book->photo ?>" alt="Book Picture">
                </a>
            <?php else: ?>
                <img style="width:150px" class="profile-user-img img-responsive img-circle" src="/files/noimage.jpg" alt="Book Picture">  
            <?php endif; ?>

              <h3 class="profile-username text-center"><?= $this->Html->link($request->book->title,['controller' => 'Books', 'action' => 'view', $request->book_id]) ?></h3>

              <p class="text-muted text-center"><?php echo"Request id - $request->id" ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>No of Weeks</b> <a class="pull-right"><?= $this->Number->format($request->Weeks) ?></a>
                </li>
                <li class="list-group-item">
                  <b>Status</b> <a class="pull-right"><?php 
                        if($request->ownerAck == 0) echo 'Your response pending';
                        elseif($request->ownerAck == 1) echo 'Accepted';
                        elseif($request->ownerAck == 2) echo 'Declined';
                        elseif($request->ownerAck == 3) echo 'Cancelled by borrower';
                        elseif($request->ownerAck == 4) echo 'Book Issued';
                    ?></a>
                </li>
                <li class="list-group-item">
                  <b>Borrower</b> <a class="pull-right"><?= $this->Html->link($request->borrower->name, ['controller' => 'Users', 'action' => 'view', $request->borrower->id], ['class' => 'pull-right'])?></a>
                </li>
                <li class="list-group-item">
                  <b>Rent Paid</b> <a class="pull-right"><?= h($request->rentPaid)?'Yes':'No' ?></a>
                </li>
                <li class="list-group-item">
                  <b>Created On</b> <a class="pull-right"><?php echo $request->created ?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <?php if($request->ownerAck == 0): ?>
                    <div class="callout callout-info">
                        <h5>You need to accept or decline this request.</h5>
                    </div>
                    <span style="float:left; width:45%;"><?= $this->Form->postButton(__('Accept'), ['action' => 'acceptIssueRequest', $request->id], ['class' => 'btn btn-block btn-success']) ?></span>
                    <span style="float:right; width:45%;"><?= $this->Form->postButton(__('Decline'), ['action' => 'declineIssueRequest', $request->id], ['confirm' => __('Are you sure you want to decline this request for this book?', $request->id), 'class' => 'btn btn-block btn-danger']) ?></span>
                <?php elseif($request->ownerAck == 1): ?>
                    <div class="callout callout-success">
                        <h5>You have accepted this request.</h5>
                    </div>
                    <a class="btn btn-block"> Borrower still needs to pay rent.</a>
                <?php elseif($request->ownerAck == 2): ?>
                    <div class="callout callout-danger">
                        <h5>You have declined this request.</h5>
                    </div>
                    <a class="btn btn-block"> This request is closed.</a>
                <?php elseif($request->ownerAck == 3): ?>
                    <div class="callout callout-warning">
                        <h5>Borrower has cancelled this request.</h5>
                    </div>
                    <a class="btn btn-block"> This request is closed.</a>                   
                <?php elseif($request->ownerAck == 4): ?>
                    <div class="callout callout-info">
                        <h5>This book is issued to the borrower.</h5>
                    </div>
                    <a class="btn btn-block"> You can request return of this book.</a>
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
        <hr/>
        
        
        <!----- Borrow Request Start ------->
        <div class="row" style="position:relative">
        <h3>Borrow Requests</h3>
        <?php if($borrowRequests->count()): ?>
        <?php foreach ($borrowRequests as $request): ?>
        <div class="col-md-3">

          <!-- Request info -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <?php if($request->book->photo != ""): ?>
                <a href="/files/books/photo/<?= $request->book->photo?>/<?= $request->book->photo ?>" data-lightbox="image-1" data-title="<?php echo $request->book->photo ?>">
                    <img style="width:150px" class="profile-user-img img-responsive img-circle" src="/files/books/photo/<?= $request->book->photo?>/thumbnail-<?= $request->book->photo ?>" alt="Book Picture">
                </a>
            <?php else: ?>
                <img style="width:150px" class="profile-user-img img-responsive img-circle" src="/files/noimage.jpg" alt="Book Picture">  
            <?php endif; ?>

              <h3 class="profile-username text-center"><?= $this->Html->link($request->book->title,['controller' => 'Books', 'action' => 'view', $request->book_id]) ?></h3>

              <p class="text-muted text-center"><?php echo"Request id - $request->id" ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>No of Weeks</b> <a class="pull-right"><?= $this->Number->format($request->Weeks) ?></a>
                </li>
                <li class="list-group-item">
                  <b>Status</b> <a class="pull-right"><?php 
                        if($request->ownerAck == 0) echo 'Your response pending';
                        elseif($request->ownerAck == 1) echo 'Accepted';
                        elseif($request->ownerAck == 2) echo 'Declined';
                        elseif($request->ownerAck == 3) echo 'Cancelled by borrower';
                        elseif($request->ownerAck == 4) echo 'Book Issued';
                    ?></a>
                </li>
                <li class="list-group-item">
                  <b>Borrower</b> <a class="pull-right"><?= $this->Html->link($request->borrower->name, ['controller' => 'Users', 'action' => 'view', $request->borrower->id], ['class' => 'pull-right'])?></a>
                </li>
                <li class="list-group-item">
                  <b>Rent Paid</b> <a class="pull-right"><?= h($request->rentPaid)?'Yes':'No' ?></a>
                </li>
                <li class="list-group-item">
                  <b>Created On</b> <a class="pull-right"><?php echo $request->created ?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <?php if($request->ownerAck == 0): ?>
                    <div class="callout callout-info">
                        <h5>Owner response is pending ont this request.</h5>    
                    </div>
                    <?= $this->Form->postLink(__('Cancel'), ['action' => 'cancelBorrowRequest', $request->id],['class' => 'btn btn-block btn-danger']) ?>
                <?php elseif($request->ownerAck == 1): ?>
                    <div class="callout callout-success">
                        <h5>Owner has accepted this request.</h5>    
                    </div>
                    <?= $this->Html->link(__('Pay Rent'), ['action' => 'payRent', $request->id],['class' => 'btn btn-block btn-primary']) ?>
                <?php elseif($request->ownerAck == 2): ?>
                    <div class="callout callout-warning">
                        <h5>Owner has declined this request.</h5>
                    </div>
                    <a class="btn btn-block"> This request is closed.</a>
                <?php elseif($request->ownerAck == 3): ?>
                    <div class="callout callout-warning">
                        <h5>You have cancelled this request.</h5>
                    </div>
                    <a class="btn btn-block"> This request is closed.</a>
                <?php elseif($request->ownerAck == 4): ?>
                    <div class="callout callout-info">
                        <h5>The book is already issued to you.</h5>
                    </div>
                    <a class="btn btn-block"> You may return this book.</a>
                <?php endif ?>
            </div> 
        </div>
          <!-- /.box -->
        </div>
        <?php endforeach; ?>
        </div>
        <?php else: echo "Oops! It seems like there is nothing to show you here."; endif;?>
    </section>
    <!-- /.content -->


















<!--------------------------------------------------------------------------------------------------


<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
    </ul>
</nav>

<!-- Issue Request div start 
<div class="requests index large-9 medium-8 columns content">
    <h3><?= __('Issue Requests') ?></h3>
    <!-- <h4><?= __('Pending Actions') ?></h4> 
    <?php if($issueRequests->count()): ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('book_id') ?></th>
                <th><?= $this->Paginator->sort('borrower_id') ?></th>
                <th><?= $this->Paginator->sort('Weeks') ?></th>
                <th><?= $this->Paginator->sort('ownerAck', 'Status') ?></th>
                <th><?= $this->Paginator->sort('created', 'Created On') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($issueRequests as $request): ?>
            <b><?php 
                if($request->ownerAck == 0 && $request->book->status != 0):
                    echo "* Please either accept or decline the request id $request->id";
                endif;
                ?></b>
            <tr>
                <td><?= $this->Number->format($request->id) ?></td>
                <td><?= $request->has('book') ? $this->Html->link($request->book->title, ['controller' => 'Books', 'action' => 'view', $request->book->id]) : '' ?></td>
                <td><?= $request->has('borrower') ? $this->Html->link($request->borrower->name, ['controller' => 'Users', 'action' => 'view', $request->borrower->id]) : '' ?></td>
                <td><?= $this->Number->format($request->Weeks) ?></td>
                <td><?php 
                        if($request->ownerAck == 0) echo 'Pending';
                        elseif($request->ownerAck == 1) echo 'Accepted';
                        elseif($request->ownerAck == 2) echo 'Declined';
                        elseif($request->ownerAck == 3) echo 'Cancelled by borrower';
                        elseif($request->ownerAck == 4) echo 'Issued';
                    ?>
            </td>
                <td><?= h($request->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $request->id]) ?>
                    <?php 
                        if($request->book->status != 0 && $request->ownerAck == 0):
                            echo $this->Html->link(__(' | Accept'), ['action' => 'acceptIssueRequest', $request->id]);
                            echo $this->Form->postLink(__(' | Decline'), ['action' => 'declineIssueRequest', $request->id], ['confirm' => __('Are you sure you want to decline this request for this book?', $request->id)]);
                        endif;
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
    <?php else: echo "Oops! It seems like there is nothing to show here."; endif;?>
</div>

<!-- Issue Request div ends -->


<!-- Borrow Request div start 

<div class="requests index large-9 medium-8 columns content">
    <h3><?= __('Borrow Requests') ?></h3>
    <?php if($borrowRequests->count()): ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id', null, ['direction' => 'desc']) ?></th>
                <th><?= $this->Paginator->sort('book_id') ?></th>
                <th><?= $this->Paginator->sort('owner_id') ?></th>
                <th><?= $this->Paginator->sort('Weeks') ?></th>
                <th><?= $this->Paginator->sort('ownerAck', 'Status') ?></th>
                <th><?= $this->Paginator->sort('created', 'Created On') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($borrowRequests as $request): ?>
            <b><?php 
                if($request->ownerAck == 1 && $request->book->status != 0):
                    echo "* Pay rent for request id $request->id from "; 
                    echo "<a href=/requests/pay-rent/$request->id> here.</a>";
                endif;
                ?>
            </b>
            <tr>
                <td><?= $this->Number->format($request->id) ?></td>
                <td><?= $request->has('book') ? $this->Html->link($request->book->title, ['controller' => 'Books', 'action' => 'view', $request->book->id]) : '' ?></td>
                <td><?= $request->has('owner') ? $this->Html->link($request->owner->name, ['controller' => 'Users', 'action' => 'view', $request->owner->id]) : '' ?></td>
                <td><?= $this->Number->format($request->Weeks) ?></td>
                <td><?php 
                        if($request->ownerAck == 0) echo 'Pending';
                        elseif($request->ownerAck == 1) echo 'Accepted';
                        elseif($request->ownerAck == 2) echo 'Declined';
                        elseif($request->ownerAck == 3) echo 'Cancelled by you';
                        elseif($request->ownerAck == 4) echo 'Issued';
                    ?>
            </td>
                <td><?= h($request->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $request->id]) ?>
                    <?php if($request->ownerAck == 0): ?>
                    <?= $this->Form->postLink(__('Cancel'), ['action' => 'cancelBorrowRequest', $request->id], ['confirm' => __('Are you sure you want to cancel request id # {0}?', $request->id)]) ?>
                    <?php endif; ?>
                    <?php if($request->ownerAck == 1 && $request->book->status != 0): ?>
                    <?= $this->Form->postLink(__('Pay Rent'), ['action' => 'payRent', $request->id]) ?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
    <?php else: echo "Oops! It seems like there is nothing to show here."; endif;?>
</div>
<!-- Borrow Requests div end -->

