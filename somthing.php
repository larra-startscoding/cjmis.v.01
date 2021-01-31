<button type="button" class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#editModal" onclick="getDetails(<?php echo $row['member_id']; ?>,'<?php echo $row['photo']; ?>','<?php echo $row['esignature']; ?>','<?php echo $row['last_name']; ?>','<?php echo $row['first_name']; ?>','<?php echo $row['middle_name']; ?>','<?php echo $row['birthdate']; ?>','<?php echo $row['birthplace']; ?>','<?php echo $row['m_address']; ?>','<?php echo $row['citizenship']; ?>','<?php echo $row['civil_stat']; ?>','<?php echo $row['mother_name']; ?>','<?php echo $row['father_name']; ?>','<?php echo $row['educ_attn']; ?>','<?php echo $row['occupation']; ?>','<?php echo $row['baptizer']; ?>','<?php echo $row['date_baptized']; ?>','<?php echo $row['place_baptized']; ?>','<?php echo $row['chapter_id']; ?>','<?php echo $row['mintitle_id']; ?>','<?php echo $row['designation_id']; ?>','<?php echo $row['min_id']; ?>');">Edit</button>

<script src="">
function getDetails(id,photo,esig,lname,fname,mname,bdate,bplace,addr,cs,citi,educ,occu,mother,father,bap,dbap,pbap,chap,mintitle,desig,minis){
    $('input[name="uprofileImae"]').val(photo);
    $('input[name="uesigImage"]').val(esig);
    $('input[name="ulname"]').val(lname);
    $('input[name="ufname"]').val(fname);
    $('input[name="umname"]').val(mname);
    $('input[name="ubdate"]').val(bdate);
    $('input[name="ubplace"]').val(bplace);
    $('input[name="uaddr"]').val(addr);
    $('select[name="ucivilstat"]').val(cs);
    $('input[name="ucitizenship"]').val(citi);
    $('select[name="ueduc"]').val(educ);
    $('input[name="uoccupation"]').val(occu);
    $('input[name="umother"]').val(mother);
    $('input[name="ufather"]').val(father);
    $('input[name="ubaptizer"]').val(bap);
    $('input[name="udate_bap"]').val(dbap);
    $('input[name="uplace_bap"]').val(pbap);
    $('input[name="uchapter"]').val(chap);
    $('input[name="umintitle"]').val(mintitle);
    $('input[name="udesig"]').val(desig);
    $('input[name="uministry"]').val(minis);
    $("#hiddenid").val(id);
  }
</script>