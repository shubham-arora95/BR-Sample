
<!-- Content Header (Page header) -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Home
    <small>This page shows all books available.</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
    <li class="active">Here</li>
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
              <b>Owner</b> <a class="pull-right"><?= $this->Html->link($book->user->name, ['controller' => 'Users', 'action' => 'view', $book->user->id], ['class' => 'pull-right'])?></a>
            </li>
            <li class="list-group-item">
              <b>Status</b> <a class="pull-right"><?php if($book->status == 0) echo "Available"; 
                elseif($book->status == 1) echo "Requested"; 
                elseif($book->status == 2) echo "Not Available"; 
                ?></a>
            </li>  
          </ul>
        <?php if($loggedIn): ?>
            <?php if($book->user_id != $user_id): ?>
              <a href="/books/borrow/<?= $book->id ?>" class="btn btn-primary btn-block"><b>Borrow</b></a>
            <?php elseif($book->user_id == $user_id): ?>
              <a class="btn btn-block"> You own this book.</a>
            <?php endif; ?>
        <?php else: ?>
            <a href="/books/borrow/<?= $book->id ?>" class="btn btn-primary btn-block"><b>Borrow</b></a>
        <?php endif; ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <?php endforeach; ?>
    </div>       
</section>
    <!-- /.content -->