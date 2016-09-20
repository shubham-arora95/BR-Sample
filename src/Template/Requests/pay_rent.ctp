<section class="content-header">
      <h1>
        Pay rent for <?= $request->book->title ?>
        <small>Please pay the rent from below.</small>
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
        
              <h3 class="profile-username text-center"><?= $this->Html->link($request->book->title,['controller' => 'Books', 'action' => 'view', $request->book->id]) ?></h3>

              <p class="text-muted text-center"><?= h($request->book->writer) ?></p>
              <p class="text-muted text-center"><?php echo "Request id - ". $request->id ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Edition</b> <a class="pull-right"><?= h($request->book->edition) ?></a>
                </li>
                
                  <li class="list-group-item">
                  <b>Course</b> <a class="pull-right"><?= h($request->book->course) ?></a>
                </li>
                
                <li class="list-group-item">
                  <b>Price</b> <a class="pull-right"><?= h($request->book->price) ?></a>
                </li>
                
                <li class="list-group-item">
                  <b>Owner</b> <a class="pull-right"><?= $this->Html->link($request->owner->name, ['controller' => 'Users', 'action' => 'view', $request->owner->id], ['class' => 'pull-right'])?></a>
                </li>
                
                <li class="list-group-item">
                  <b>Weeks</b> <a class="pull-right"><?= $request->Weeks ?></a>
                </li>
                
                <li class="list-group-item">
                  <b>Status</b> <a class="pull-right"><?php 
                        if($request->ownerAck == 0) echo 'Pending';
                        elseif($request->ownerAck == 1) echo 'Request Accepted by Owner';
                        elseif($request->ownerAck == 2) echo 'Declined';
                        elseif($request->ownerAck == 3) echo 'Cancelled by borrower';
                    ?></a>
                </li>
                
                <li class="list-group-item">
                  <b>Rent Paid</b> <a class="pull-right"><?= $request->rentPaid ? __('Yes') : __('No'); ?></a>
                </li>
                
                <li class="list-group-item">
                <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Total Due Rs. <?php echo $total ?> (?)
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse">
                    <div class="box-body">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                              <b><?= __('Security Deposit (Will be Refunded)') ?></b> <a class="pull-right"><?= h($securityDeposit) ?></a>
                            </li>

                            <li class="list-group-item">
                              <b><?= __('Rent according to number of weeks (Rs. 2 per day) ') ?></b> <a class="pull-right"><?= h($rent) ?></a>
                            </li>

                            <li class="list-group-item">
                              <b><?= __('Total') ?></b> <a class="pull-right"><?= h($total) ?></a>
                            </li>
                        </ul>
                    </div>
                  </div>
                </div>
                </div>
                </li>
              </ul>
              </div>
              <div class="box-footer">
                  <span style="float:right">
                    <?= $this->Html->link(__("Pay Rs. $total"), ['action' => 'confirmRentPaid', $request->id],['class' => 'btn btn-primary']) ?>
                    <?= $this->Html->link(__("Cancel Request"), ['action' => 'cancelBorrowRequest', $request->id],['confirm' => __('Are you sure you want to cancel request id # {0}?', $request->id), 'class' => 'btn btn-danger']) ?>
                  </span>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>     
</section>
    <!-- /.content -->