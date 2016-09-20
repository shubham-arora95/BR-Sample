<section class="content-header">
      <h1>
        <?php 
          if($user->id == $user_id) echo "Your Profile";
          else echo $user->name."'s Profile";
        ?>
        <small>You can view your profile from here.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Users</a></li>
        <li class="active">Profile</li>
      </ol>
</section>

    <!-- Main content -->
    <section class="content">
      <!-- Your Page Content Here -->
        <div class="row" style="position:relative">
            
        <div class="col-md-3" style="width:100%">

          <!-- User info -->
          <div class="box box-primary" >
            <div class="box-body box-profile">
            <a href="/files/users/photo/<?= $user->id?>/<?= $user->photo ?>" data-lightbox="image-1" data-title="<?php echo $user->photo ?>">
                <img style="width:200px" class="profile-user-img img-responsive img-circle" src="/files/users/photo/<?= $user->id?>/thumbnail-<?= $user->photo?>" alt="User Picture">
            </a>
              <h3 class="profile-username text-center"><?= $user->name ?></h3>

              <p class="text-muted text-center"><?php echo "Member since - ".$user->created; ?></p>
              <p class="text-muted text-center"><?php echo "Profile last updated on - ".$user->modified; ?></p>
              <ul class="list-group list-group-unbordered">

                <li class="list-group-item">
                    <b>No. of books added</b> <a class="pull-right"><?= $books->count() ?></a>
                </li>

                <li class="list-group-item">
                    <b>Phone No.</b> <a class="pull-right"><?= $user->phone ?></a>
                </li>
                
                <li class="list-group-item">
                    <b>Address</b> <a class="pull-right"><?= $user->address ?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
            </div>
            </div>
        </div>
    
        <div class="panel box box-primary">
            <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Added Books
                      </a>
                    </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="box-body">
                    <?php if($books->count()): ?>
                    <div class="row" style="position:relative">
                    <?php foreach ($books as $book): ?>
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
                              <b>Owner</b> <a class="pull-right"><?= $this->Html->link($book->user->name, ['controller' => 'Users', 'action' => 'view', $book->user_id], ['class' => 'pull-right'])?></a>
                            </li>
                            <li class="list-group-item">
                              <b>Status</b> <a class="pull-right"><?php if($book->status == 0) echo "Available"; 
                                elseif($book->status == 1) echo "Requested"; 
                                elseif($book->status == 2) echo "Not Available"; 
                                ?></a>
                            </li>  
                          </ul>
                        <?php if($book->status == 0 && $book->user_id != $user_id): ?>
                          <a href="/books/borrow/<?= $book->id ?>" class="btn btn-primary btn-block"><b>Borrow</b></a>
                        <?php else: ?>
                          <a href="/books/view/<?= $book->id ?>" class="btn btn-primary btn-block"><b>View Book</b></a>
                        <?php endif ?>
                        </div>
                        <!-- /.box-body -->
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
        <?php if($user->id == $user_id) echo $this->Html->link(__('Edit Profile'),['action' => 'edit', $user->id],['class' => 'btn btn-primary btn-primary']) ?>
    </section>
    <!-- /.content -->

