<section class="content-header">
    <h1>
        My Payments
        <small>This page shows all your paid and pending payments.</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Users</a></li>
        <li class="active">Profile</li>
    </ol>
</section>

<section class="content">
    <div class="panel box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                Pending Paymnets
                </a>
            </h4>
        </div>
        
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="box-body">
                    <?php if($pendingPayments->count()): ?>
                    <div class="row" style="position:relative">
                    <?php foreach ($pendingPayments as $request): ?>
                    <div class="col-md-3">

                      <!-- Book info -->
                      <div class="box box-primary">
                        <div class="box-body box-profile">
                          <?php if($book->photo != ""): ?>
                            <a href="/files/books/photo/<?= $book->id?>/<?= $book->photo ?>" data-lightbox="image-1" data-title="<?php echo $book->photo ?>">
                                <img style="width:150px" class="profile-user-img img-responsive img-circle" src="/files/books/photo/<?= $book->id?>/thumbnail-<?= $book->photo ?>" alt="Book Picture">
                            </a>
                        <?php else: ?>
                            <img style="width:150px" class="profile-user-img img-responsive img-circle" src="/files/noimage.jpg" alt="Book Picture">  
                        <?php endif; ?>
                            
                            <h5 class="profile-username text-center"> Payment for book - <a href="/books/view/<?php echo $request->book_id ?>"><?= $request->book->title ?></a></h5>

                            <p class="text-muted text-center"><?php echo "Request id - ".$request->id ?></p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Book</b> <a href="/books/view/<?php echo $request->book_id ?>" class="pull-right"><?= $request->book->title ?></a>
                                </li>
                                
                                <li class="list-group-item">
                                    <b>No of Weeks</b> <a class="pull-right"><?= $request->Weeks ?></a>
                                </li>
                                
                                <li class="list-group-item">
                                    <b>Owner</b> <a href="/users/view/<?php echo $request->owner_id ?>" class="pull-right"><?= $request->owner->name ?></a>
                                </li>
                                
                                <li class="list-group-item">
                                    <b>Request Status</b> 
                                    <a class="pull-right">
                                        <?php 
                                            if($request->ownerAck == 0) echo 'Pending';
                                            elseif($request->ownerAck == 1) echo 'Accepted';
                                            elseif($request->ownerAck == 2) echo 'Declined';
                                            elseif($request->ownerAck == 3) echo 'Cancelled by borrower';
                                            elseif($request->ownerAck == 4) echo 'Issued';
                                        ?>
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <?php
                        // Show pay rent button only if owner has accepted the request
                            if($request->ownerAck == '1')
                                echo $this->Html->link(__('Pay Rent'), ['action' => 'payRent', $request->id], ['class' => 'btn btn-block btn-primary']);
                        /* Show cancel button only if the status is pending */
                            if($request->ownerAck == 0 || $request->ownerAck == 1)
                                echo "<br/>".$this->Html->link(__('Cancel'), ['action' => 'cancelBorrowRequest', $request->id], ['class' => 'btn btn-block btn-danger'], ['confirm' => __('Are you sure you want to cancel this request for this book?', $request->id)]);
                            ?>
                        </div>
                      </div>
                      <!-- /.box -->
                    </div>
                    <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                        Oops! It seems like there is nothing to show you here.
                    <?php endif ?>
                </div>
        </div>
    </div>
    
    <!--------------------------- Paid payments start ------------------------------>
    
    <div class="panel box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                Paid Paymnets
                </a>
            </h4>
        </div>
        
        <div id="collapseTwo" class="panel-collapse collapse in">
            <div class="box-body">
            <?php if($paidPayments->count()): ?>
                <div class="row" style="position:relative">
                <?php foreach($paidPayments as $request): ?>
                    <div class="box box-primary">
                        <div class="box-body box-profile" >
                            <img class="profile-user-img img-responsive img-circle" src="/img/user4-128x128.jpg" alt="<?php echo $request->id ?>">
                            
                            <h3 class="profile-username text-center"> Payment for transaction id - <?php echo $request->transaction_id ?></h3>

                            <p class="text-muted text-center"><?php echo "Request id - ".$request->id ?></p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Book</b> <a href="/books/view/<?php echo $request->book_id ?>" class="pull-right"><?= $request->book->title ?></a>
                                </li>
                                
                                <li class="list-group-item">
                                    <b>No of Weeks</b> <a class="pull-right"><?= $request->Weeks ?></a>
                                </li>
                                
                                <li class="list-group-item">
                                    <b>Owner</b> <a href="/users/view/<?php echo $request->owner_id ?>" class="pull-right"><?= $request->owner->name ?></a>
                                </li>
                                
                                <li class="list-group-item">
                                    <b>Payment Date</b> <a class="pull-right"><?= $request->payment_date ?></a>
                                </li>
                                
                            </ul>
                        </div>
                    
                    </div>
                    <?php endforeach; ?>
                </div>
                
            </div>
            
            <div class="box-footer">
                <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                </ul>
                <p><?= $this->Paginator->counter() ?></p>
            </div>
            </div>
    
            <?php else: echo "Oops! It seems like there is nothing to show here."; endif;?>
        </div>
    </div>
</section>