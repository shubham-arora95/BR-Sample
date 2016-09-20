<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
        <div class="col-md-3" style="width:100%">

          <!-- Book info -->
          <div class="box box-primary">
            <div class="box-body box-profile" style="width:100%">
                
                <div class="callout callout-success">
                    <h4>Congratulation your transaction is completed successfully.</h4>

                    <p><?php echo "Your transaction id is:<b> $transaction->id </b> and unique code is: <b> $transaction->random </b>. Don't forget to show this code to the owner of this book at the time of pick up. <br/> Your issue date is: $transaction->issue_date and return date is: $transaction->return_date. "; ?></p>
                </div>
                
                <div class="callout callout-info">
                    <h4>Note: This is atmost important</h4>

                    <p>If you don't give the unique code: <b><?= $transaction->random ?></b> to the owner, the owner may decline to give you book at the time of pickup.</p>
                </div>
        <h5>See the details of your transaction from below - </h5>

              <ul class="list-group list-group-unbordered">
                <!----- Book Desc Start -->
                <li class="list-group-item">
                    <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Book Details
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse">
                        <div class="box-body">
                            <img class="profile-user-img img-responsive img-circle" src="/img/user4-128x128.jpg" alt="User profile picture">

                            <h3 class="profile-username text-center"><?= $this->Html->link($transaction->book->title,['controller' => 'Books', 'action' => 'view', $transaction->book->id]) ?></h3>

                            <p class="text-muted text-center"><?= h($transaction->book->writer) ?></p>
                            <ul class="list-group list-group-unbordered">
                               <li class="list-group-item">
                                    <b>Edition</b> <a class="pull-right"><?= h($transaction->book->edition) ?></a>
                                </li>

                                <li class="list-group-item">
                                    <b>Course</b> <a class="pull-right"><?= h($transaction->book->course) ?></a>
                                </li>

                                <li class="list-group-item">
                                    <b>Owner</b> <a class="pull-right"><?= $this->Html->link($transaction->owner->name, ['controller' => 'Users', 'action' => 'view', $transaction->book->id], ['class' => 'pull-right'])?></a>
                                </li>

                                <li class="list-group-item">
                                    <b>Price</b> <a class="pull-right"><?= $transaction->book->price ?></a>
                                </li>

                                <li class="list-group-item">
                                    <div class="box-group" id="accordion">
                                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                    <div class="panel box box-primary">
                                      <div class="box-header with-border">
                                        <h5>
                                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            Description
                                          </a>
                                        </h5>
                                      </div>
                                      <div id="collapseTwo" class="panel-collapse collapse in">
                                        <div class="box-body">
                                          <?= $this->Text->autoParagraph(h($transaction->book->description)); ?>
                                        </div>
                                      </div>
                                    </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    </div>
                    </div>
                </li>
                <!---- Book Desc ends -->
                
                <!--- Transaction Desc starts ---->
                <li class="list-group-item">
                    <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            Transaction Details
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse in">
                        <div class="box-body">
                            <ul class="list-group list-group-unbordered">
                               <li class="list-group-item">
                                    <b>Transaction id</b> <a class="pull-right"><?= h($transaction->id) ?></a>
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
                                    <b>Request id</b> <a class="pull-right"><?= $transaction->request_id ?></a>
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
                    </div>
                    </div>
                    </div>
                </li>
              </ul>
            </div>
            </div>
        </div>
</section>
    <!-- /.content -->