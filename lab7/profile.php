<?php
include 'header.php';
require 'db.php';
$sql= "select * from student 
        Where studentID='{$_SESSION['user']['studentID']}'";
$result = $conn->query($sql);
$student= $result->fetch_assoc();
?>
<form action="saveProfile.php" method="post" enctype="multipart/form-data">
   <div class="row">
     <div class="col-md-4 border-right">
       <div class="d-flex flex-column align-items-center text-center p-3 py-5">
         <label for="profile-image" class="mb-3">
           <div id="image">
          <img class='img-fluid' src="images/profiles/<?php echo $student['image']; ?>" alt="profile image">
           </div>
           <input class="form-control d-none" type="file" accept="image/*" name="image" id="profile-image" onchange="preview()">
         </label>
       </div>
     </div>
     <div class="col-md-8 border-right">
       <div class="p-3 py-5">
         <div class="d-flex justify-content-between align-items-center mb-3">
           <h4 class="text-right">Profile Settings</h4>
         </div>
         <div class="row mt-2">
           <div class="mb-2">
             <label for="student-id" class="form-label">Student ID</label>
             <input required name="studentID" type="text" class="form-control" id="student-id"
             value="<?php echo $student['studentID'];?>" disabled>
           </div>
           <div class="mb-2">
             <label for="student-name" class="form-label">Student Name</label>
             <input required name="fristname" type="text" class="form-control" id="student-name"
             value="<?php echo $student['fristname'];?>">
             <div class="mb-2">
             <label for="lastname" class="form-label">Lastname</label>
             <input required name="lastname" type="text" class="form-control" id="lastname"
             value="<?php echo $student['lastname'];?>">
           </div>
           <div class="mb-2">
             <label for="major" class="form-label">Major</label>
             <select name="majorID" class="form-select" id="major">
<?php
$sql = 'select * from major order by faculty';
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
echo "<option value='{$row['majorID']}'".($row['majorID']==$student['majorID']?' selected':'').">
     {$row['faculty']}-{$row['majotNAME']}
   </option>";
}
$conn->close();
?>
             </select>
           </div>
         </div>
         <div class="mt-5 text-center">
           <button name="submit" class="btn btn-primary" type="submit">Save Profile</button>
         </div>
       </div>
     </div>
   </div>
 </form>
 <script>
  function preview(){

   const profileImage = document.getElementById('profile-image');
   const image = document.getElementById('image');
   image.innerHTML = '<img class="img-fluid rounded-circle">';
   const img = image.querySelector('img');
   img.src = URL.createObjectURL(profileImage.files[0]);
   img.onload = () => {
     URL.revokeObjectURL(img.src);
   };
 }
 </script>
<?php
include 'footer.php';
?>
