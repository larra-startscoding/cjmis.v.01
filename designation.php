<?php
    include("config.php");

    //click Save
    if(isset($_POST['add'])){
      //get values
      $designation=$_POST['desig'];
      $shorthand=$_POST['shorth'];
      //add
      $sql="INSERT INTO tbldesignation(designation,shorthand) values ('$designation','$shorthand')";
      if(!$result=mysqli_query($connection,$sql)){
        exit(mysqli_error($connection));
      }
    }
    //delete
    if(isset($_POST['del'])){
      $getID=$_POST['xid'];

      $sql="DELETE FROM tbldesignation WHERE designation_id='$getID'";  
      if(!$result=mysqli_query($connection,$sql)){
        exit(mysqli_error($connection));
      }
    }
    
    //edit
    if(isset($_POST['edit'])){
      $desigid=$_POST['hiddenID'];
      $desig=$_POST['update_desig'];
      $shorthand=$_POST['update_shorth'];

      $sql="UPDATE tbldesignation SET designation='$desig', shorthand='$shorthand' WHERE designation_id=$desigid";  
      if(!$result=mysqli_query($connection,$sql)){
        exit(mysqli_error($connection));
      }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>

    <!-- imports -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
</head>
<body>

    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">CJ Member Information System</a>
      <ul class="navbar-nav px-4">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="index.php">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Set-up</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="ministry.php">
                  <span data-feather="file-text"></span>
                  Ministry
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="chapter.php">
                  <span data-feather="file-text"></span>
                  Chapter
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="ministryTitle.php">
                  <span data-feather="file-text"></span>
                  Ministerial Title
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="designation.php">
                  <span data-feather="file-text"></span>
                  Designation
                </a>
              </li>
            </ul>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Transation</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="member.php">
                  <span data-feather="file-text"></span>
                  Member
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Manage Designation</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>
            </div>
          </div>
          <!-- ---alert--- -->
          <?php
            if(isset($_POST['edit'])){ 
            echo '<div class="alert alert-success alert-dismissible fade show">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Record updated.</div>';
            }
            if(isset($_POST['add'])){ 
              echo '<div class="alert alert-success alert-dismissible fade show">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> Record added.</div>';
            }
            if(isset($_POST['del'])){ 
              echo '<div class="alert alert-success alert-dismissible fade show">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> Record deleted.</div>';
            }
          ?>
          <form action="ministry.php" method="POST">
          <div class="card">
            <div class="card-header">
              <h3>List of Ministerial Title
              <span><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addModal">Add</button></span></h3>
            </div>
            <div class="card-body">
          <!--    table      -->
              <div class="table-responsive">
                <table class="table table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Designation</th>
                      <th>Abbrevation</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql="SELECT * FROM tbldesignation";
                      $result=mysqli_query($connection,$sql);
                      while($row=mysqli_fetch_array($result))
                      {
                    ?>
                    <tr>
                      <td><?php echo $row['designation']?></td>
                      <td><?php echo $row['shorthand']?></td>
                      <td>
                        <button type="button" class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#editModal" onclick="getDetails(<?php echo $row['designation_id']; ?>,'<?php echo $row['designation']; ?>','<?php echo $row['shorthand']; ?>');">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" name="delete" data-toggle="modal" data-target="#delModal" onclick="deletexid(<?php echo $row['designation_id']; ?>);">Delete</button>
                      </td>
                    </tr>
                    <?php
                      }
                      mysqli_close($connection);
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          </form>
        </main>
        <!--  Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="Add Ministry" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add Designation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="" method="POST" class="form-horizontal">
              <div class="modal-body">
                <div class="form-group">
                  <label for="minName" class="control-label">Designation</label>
                  <input type="text" name="desig" class="form-control" placeholder="Designation" required autofocus>
                </div>
                <div class="form-group">
                  <label for="minName" class="control-label">Abbrevation</label>
                  <input type="text" name="shorth" class="form-control" placeholder="Abbrevation" required >
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm" name="add">Save</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              </div>
            </div>
            </form>
          </div>
        </div>
        <!--  Delete Modal -->
        <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Delete Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="" method="POST" class="form-horizontal">
              <div class="modal-body">
                <div class="card-body">
                  <h4>Are you sure you want to delete?</h4>
                </div>
              </div>
              <div class="modal-footer">
                <input type="hidden" name="xid" id="delid">
                <button type="submit" class="btn btn-primary btn-sm" name="del">Yes</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
              </div>
            </div>
            </form>
          </div>
        </div>
        <!--  Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="" method="POST" class="form-horizontal">
              <div class="modal-body">
                <div class="card-body">
                  <div class="form-group">
                    <label for="minName" class="control-label">Designation</label>
                    <input type="text" name="update_desig" class="form-control" required autofocus></input>
                  </div>
                  <div class="form-group">
                    <label for="minName" class="control-label">Abbrevation</label>
                    <input type="text" name="update_shorth" class="form-control" required ></input>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm" name="edit">Save Changes</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <input type="hidden" name="hiddenID" id="hiddenid">
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</body>
</html>

<script>
  function deletexid(x){
    $("#delid").val(x);
  }

  function getDetails(id,desig,shorth){
    $('input[name="update_desig"]').val(desig);
    $('input[name="update_shorth"]').val(shorth);
    $("#hiddenid").val(id);
  }

  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);
</script>