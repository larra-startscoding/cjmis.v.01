<?php
    include("config.php");


    //click Save
    if(isset($_POST['add'])){
      //get values
      $lastn=$_POST['lname'];
      $firstn=$_POST['fname'];
      $middlen=$_POST['mname'];
      $bday=$_POST['bdate'];
      $bplace=$_POST['bplace'];
      $address=$_POST['addr'];
      $cs=$_POST['civilstat'];
      $citizen=$_POST['citizenship'];
      $educattn=$_POST['educ'];
      $occu=$_POST['occupation'];
      $moth=$_POST['mother'];
      $fath=$_POST['father'];
      $bap=$_POST['baptizer'];
      if(empty($_POST['date_bap'])){
        $dbap='0000/00/00';
      }
      else{
        $dbap=$_POST['date_bap'];
      }
      
      $pbap=$_POST['place_bap'];
      $chap=$_POST['chapter'];
      $mint=$_POST['mintitle'];
      $desig=$_POST['desig'];
      $minis=$_POST['ministry'];
      

      //for pic
      $profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
      $esigName = time() . '-' . $_FILES["esigImage"]["name"];
      //upload
      $target_dir = "images/photos/";
      $target_dir2 = "images/esign/";
      $target_file = $target_dir . basename($profileImageName);
      $target_file2 = $target_dir2 . basename($esigName);

      move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file);
      move_uploaded_file($_FILES["esigImage"]["tmp_name"], $target_file2);

      //add
      $sql = "INSERT INTO tblmember(last_name,first_name,middle_name,birthdate,birthplace,m_address,civil_stat,citizenship,mother_name,father_name,educ_attn,occupation,baptizer,date_baptized,place_baptized,chapter_id,mintitle_id,designation_id,min_id,photo,esignature) VALUES ('$lastn','$firstn','$middlen','$bday','$bplace','$address','$cs','$citizen','$moth','$fath','$educattn','$occu','$bap','$dbap','$pbap','$chap','$mint','$desig','$minis','$profileImageName','$esigName')";
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
  
    
    //pagination
    if (isset($_GET['pageno'])) {
      $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $no_of_records_per_page = 10;
    $offset = ($pageno-1) * $no_of_records_per_page;

    $total_pages_sql = "SELECT COUNT(*) FROM tblmember";
    $result = mysqli_query($connection,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);

    
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
                <a class="nav-link" href="designation.php">
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
                <a class="nav-link active" href="member.php">
                  <span data-feather="file-text"></span>
                  Member
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Manage Members</h1>
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

          <form action="ministry.php" method="POST"  enctype="multipart/form-data">
          <div class="card">
            <div class="card-header">
              <h3>List of Members
              <span><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addModal">Add</button></span></h3>
            </div>
            <div class="card-body">
          <!--    table      -->
              <div class="table-responsive">
                <div class="form-group">
                Show <input type="number" name="" id="" value="10"></input>entries
                </div> 
                <table class="display table table-striped table-sm" id="membersTable">
                  <thead>
                    <tr>
                      <th>Member ID</th>
                      <th>Image</th>
                      <th>Last Name</th>
                      <th>First Name</th>
                      <th>Middle Name</th>
                      <th>Chapter</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql="SELECT tblmember.member_id, tblmember.photo, tblmember.esignature, tblmember.last_name, tblmember.first_name, tblmember.middle_name, tblchapter.chapter FROM tblmember INNER JOIN tblchapter ON tblmember.chapter_id=tblchapter.chapter_id LIMIT $offset, $no_of_records_per_page";
                      $result=mysqli_query($connection,$sql);
                      while($row=mysqli_fetch_array($result))
                      {
                    ?>
                    <tr>
                      <td><?php echo $row['member_id']?></td>
                      <td><img src="<?php echo 'images/photos/'.$row['photo']?>" width="50" height="50" alt="No image"></td>
                      <td><?php echo $row['last_name']?></td>
                      <td><?php echo $row['first_name']?></td>
                      <td><?php echo $row['middle_name'][0]?></td>
                      <td><?php echo $row['chapter']?></td>
                      <td>
                        <button type="button" class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#editModal" onclick="getDetails(<?php echo $row['member_id']; ?>,'<?php echo $row['photo']; ?>','<?php echo $row['esignature']; ?>','<?php echo $row['last_name']; ?>','<?php echo $row['first_name']; ?>','<?php echo $row['middle_name']; ?>');">Edit</button>
                        
                      </td>
                    </tr>
                    <?php
                      }
                      // mysqli_close($connection);
                    ?>
                  </tbody>
                  <tfoot></tfoot>
                </table>
                <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-end">
                    <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                      <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" tabindex="-1">Previous</a>
                    </li>
                    <!-- <li class="page-item"><a class="page-link" href="?pageno=1">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="?pageno=<?php //echo $total_pages; ?>">3</a></li> -->
                    <?php
                      for ($i=1; $i<=$total_pages; $i++) {
                        echo "<li class='page-item'><a class='page-link' href='?pageno=".$i."'>".$i."</a></li>";	
                      }
                    ?>
                    <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                      <a class="page-link " href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
          </form>
        </main>
        <!--  Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="Add Ministry" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="" method="POST" class="form-horizontal"  enctype="multipart/form-data">
              <div class="modal-body">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group wrapper">
                      <img src="images/avatar.png" alt="member image" id="profileDisplay" style="display: block; height: 180px; width: 50%; margin: 0px auto; border-radius: 50%;">
                      <label for="minName" class="control-label">Photo</label>
                      <input type="file" class="form-control" accept="image/*" name="profileImage" onChange="displayImage(this)" style="overflow:auto;">
                      
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <img src="images/avatar.png" alt="member image" id="esigDisplay" style="display: block; height: 180px; width: 50%; margin: 0px auto;">
                      <label for="minName" class="control-label">E-signature</label>
                      <input type="file" class="form-control" accept="image/*" name="esigImage" onChange="displayEsig(this)" style="overflow:auto;" >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm">
                    <div class="form-group">
                      <label for="minName" class="control-label">Last Name*</label>
                      <input type="text" name="lname" class="form-control" placeholder="Last Name" required autofocus>
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="form-group">
                      <label for="minName" class="control-label">First Name*</label>
                      <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="form-group">
                      <label for="minName" class="control-label">Middle Name*</label>
                      <input type="text" name="mname" class="form-control" placeholder="Middle Name" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="minName" class="control-label">Birthdate*</label>
                      <input type="date" name="bdate" class="form-control" required id="datePickerId">
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="form-group">
                    <label for="minName" class="control-label">Birth Place*</label>
                    <input type="text" name="bplace" class="form-control" placeholder="Birth Place" required >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="minName" class="control-label">Address*</label>
                      <input type="text" name="addr" class="form-control" required >
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="minName" class="control-label" >Civil Status*</label>
                      <select class="form-control" name="civilstat" id="" required>
                        <option value="" selected disabled>---Select---</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Separated">Separated</option>
                        <option value="Widow/Widower">Widow/Widower</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="minName" class="control-label">Citizenship*</label>
                      <input type="text" name="citizenship" class="form-control" placeholder="Citizenship" value="Filipino" required >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="minName" class="control-label" >Educational Attainment*</label>
                      <select class="form-control" name="educ" id="" required>
                        <option value="" disabled selected>---Select Educational Attainment---</option>
                        <option value="Elementary Undergraduate">Elementary Undergraduate</option>
                        <option value="Elementary Graduate">Elementary Graduate</option>
                        <option value="High School Undergraduate">High School Undergraduate</option>
                        <option value="High School Graduate">High School Graduate</option>
                        <option value="College Undergraduate">College Undergraduate</option>
                        <option value="College Graduate">College Graduate</option>
                        <option value="Post Graduate<">Post Graduate</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="minName" class="control-label">Occupation</label>
                      <input type="text" name="occupation" class="form-control" placeholder="Occupation"  >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="minName" class="control-label">Mother's Name</label>
                      <input type="text" name="mother" class="form-control" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="minName" class="control-label">Father's Name</label>
                      <input type="text" name="father" class="form-control" placeholder="Citizenship" >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="minName" class="control-label">Baptizer</label>
                      <input type="text" name="baptizer" class="form-control" placeholder="Baptizer" >
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="minName" class="control-label">Date Baptized</label>
                      <input type="date" name="date_bap" class="form-control" id="datePickerId2">
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label for="minName" class="control-label">Place Baptized</label>
                      <input type="text" name="place_bap" class="form-control" placeholder="Place Baptized"  >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="minName" class="control-label">Chapter*</label>
                      <select class="form-control" name="chapter" id="" required>
                        <option value="" disabled selected>---Select Chapter---</option>
                      <?php
                        $getChap="SELECT * FROM tblchapter ORDER BY chapter ASC";
                        $resultChap=mysqli_query($connection,$getChap);
                        while($rowChap=mysqli_fetch_array($resultChap))
                        {
                        echo "<option value=".$rowChap['chapter_id'].">".$rowChap['chapter']."</option>";
                      } ?>
                      </select>
                       
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="minName" class="control-label">Ministry Title*</label>
                      <select class="form-control" name="mintitle" id="" required>
                        <option value="" selected disabled>---Select Ministry Title---</option>
                        <?php
                          $sql="SELECT * FROM tblministry_title ORDER BY mintitle_name ASC";
                          $result=mysqli_query($connection,$sql);
                          while($row=mysqli_fetch_array($result))
                          {
                          echo "<option value=".$row['mintitle_id'].">".$row['mintitle_name']."</option>";
                          } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="minName" class="control-label">Designation*</label>
                      <select class="form-control" name="desig" id="" required>
                        <option value="" selected disabled>---Select Designation---</option>
                        <?php
                          $sql="SELECT * FROM tbldesignation ORDER BY designation ASC";
                          $result=mysqli_query($connection,$sql);
                          while($row=mysqli_fetch_array($result))
                          {
                          echo "<option value=".$row['designation_id'].">".$row['designation']."</option>";
                          } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="minName" class="control-label">Ministry*</label>
                      <select class="form-control" name="ministry" id="" required>
                        <option value="" selected disabled>---Select Ministry---</option>
                        <?php
                          $sql="SELECT * FROM tblministry ORDER BY ministry ASC";
                          $result=mysqli_query($connection,$sql);
                          while($row=mysqli_fetch_array($result))
                          {
                          echo "<option value=".$row['min_id'].">".$row['ministry']."</option>";
                          } ?>
                      </select>
                    </div>
                  </div>
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
              <form action="" method="POST" class="form-horizontal"  enctype="multipart/form-data">
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
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="" method="POST" class="form-horizontal"  enctype="multipart/form-data">
              <div class="modal-body">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group wrapper">
                      <img src="images/avatar.png" alt="member image" id="profileDisplay" style="display: block; height: 180px; width: 50%; margin: 0px auto; border-radius: 50%;">
                      <label for="minName" class="control-label">Photo</label>
                      <input type="file" class="form-control" accept="image/*" name="uprofileImage" onChange="displayImage(this)" style="overflow:auto;">
                      
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <img src="images/avatar.png" alt="member image" id="esigDisplay" style="display: block; height: 180px; width: 50%; margin: 0px auto;">
                      <label for="minName" class="control-label">E-signature</label>
                      <input type="file" class="form-control" accept="image/*" name="uesigImage" onChange="displayEsig(this)" style="overflow:auto;" >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm">
                    <div class="form-group">
                      <label for="minName" class="control-label">Last Name*</label>
                      <input type="text" name="ulname" class="form-control" placeholder="Last Name" required autofocus>
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="form-group">
                      <label for="minName" class="control-label">First Name*</label>
                      <input type="text" name="ufname" class="form-control" placeholder="First Name" required>
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="form-group">
                      <label for="minName" class="control-label">Middle Name*</label>
                      <input type="text" name="umname" class="form-control" placeholder="Middle Name" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="minName" class="control-label">Birthdate*</label>
                      <input type="date" name="ubdate" class="form-control" required id="datePickerId">
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="form-group">
                    <label for="minName" class="control-label">Birth Place*</label>
                    <input type="text" name="ubplace" class="form-control" placeholder="Birth Place" required >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="minName" class="control-label">Address*</label>
                      <input type="text" name="uaddr" class="form-control" required >
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="minName" class="control-label" >Civil Status*</label>
                      <select class="form-control" name="ucivilstat" id="" required>
                        <option value="" selected disabled>---Select---</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Separated">Separated</option>
                        <option value="Widow/Widower">Widow/Widower</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="minName" class="control-label">Citizenship*</label>
                      <input type="text" name="ucitizenship" class="form-control" placeholder="Citizenship" value="Filipino" required >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="minName" class="control-label" >Educational Attainment*</label>
                      <select class="form-control" name="ueduc" id="" required>
                        <option value="" disabled selected>---Select Educational Attainment---</option>
                        <option value="Elementary Undergraduate">Elementary Undergraduate</option>
                        <option value="Elementary Graduate">Elementary Graduate</option>
                        <option value="High School Undergraduate">High School Undergraduate</option>
                        <option value="High School Graduate">High School Graduate</option>
                        <option value="College Undergraduate">College Undergraduate</option>
                        <option value="College Graduate">College Graduate</option>
                        <option value="Post Graduate<">Post Graduate</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="minName" class="control-label">Occupation</label>
                      <input type="text" name="uoccupation" class="form-control" placeholder="Occupation"  >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="minName" class="control-label">Mother's Name</label>
                      <input type="text" name="umother" class="form-control" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="minName" class="control-label">Father's Name</label>
                      <input type="text" name="ufather" class="form-control" placeholder="Citizenship" >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="minName" class="control-label">Baptizer</label>
                      <input type="text" name="ubaptizer" class="form-control" placeholder="Baptizer" >
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="minName" class="control-label">Date Baptized</label>
                      <input type="date" name="udate_bap" class="form-control" id="datePickerId2">
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label for="minName" class="control-label">Place Baptized</label>
                      <input type="text" name="uplace_bap" class="form-control" placeholder="Place Baptized"  >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="minName" class="control-label">Chapter*</label>
                      <select class="form-control" name="chapter" id="" required>
                        <option value="" disabled selected>---Select Chapter---</option>
                      <?php
                        $getChap="SELECT * FROM tblchapter ORDER BY chapter ASC";
                        $resultChap=mysqli_query($connection,$getChap);
                        while($rowChap=mysqli_fetch_array($resultChap))
                        {
                        echo "<option value=".$rowChap['chapter_id'].">".$rowChap['chapter']."</option>";
                      } ?>
                      </select>
                       
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="minName" class="control-label">Ministry Title*</label>
                      <select class="form-control" name="mintitle" id="" required>
                        <option value="" selected disabled>---Select Ministry Title---</option>
                        <?php
                          $sql="SELECT * FROM tblministry_title ORDER BY mintitle_name ASC";
                          $result=mysqli_query($connection,$sql);
                          while($row=mysqli_fetch_array($result))
                          {
                          echo "<option value=".$row['mintitle_id'].">".$row['mintitle_name']."</option>";
                          } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="minName" class="control-label">Designation*</label>
                      <select class="form-control" name="desig" id="" required>
                        <option value="" selected disabled>---Select Designation---</option>
                        <?php
                          $sql="SELECT * FROM tbldesignation ORDER BY designation ASC";
                          $result=mysqli_query($connection,$sql);
                          while($row=mysqli_fetch_array($result))
                          {
                          echo "<option value=".$row['designation_id'].">".$row['designation']."</option>";
                          } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="minName" class="control-label">Ministry*</label>
                      <select class="form-control" name="ministry" id="" required>
                        <option value="" selected disabled>---Select Ministry---</option>
                        <?php
                          $sql="SELECT * FROM tblministry ORDER BY ministry ASC";
                          $result=mysqli_query($connection,$sql);
                          while($row=mysqli_fetch_array($result))
                          {
                          echo "<option value=".$row['min_id'].">".$row['ministry']."</option>";
                          } ?>
                      </select>
                    </div>
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

  $(document).ready( function () {
      $('#membersTable').DataTable();
  } );

  function deletexid(x){
    $("#delid").val(x);
  }

  function getDetails(id,photo,esig,lname,fname,mname){
    // $('input[name="uprofileImae"]').val(photo);
    // $('input[name="uesigImage"]').val(esig);
    $('input[name="ulname"]').val(lname);
    $('input[name="ufname"]').val(fname);
    $('input[name="umname"]').val(mname);

    $("#hiddenid").val(id);
  }

  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
  }, 2000);


  function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
      }
    reader.readAsDataURL(e.files[0]);
    }
  }

  function displayEsig(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#esigDisplay').setAttribute('src', e.target.result);
      }
    reader.readAsDataURL(e.files[0]);
    }
  }

  datePickerId.max = new Date().toISOString().split("T")[0];
  datePickerId2.max = new Date().toISOString().split("T")[0];
</script>