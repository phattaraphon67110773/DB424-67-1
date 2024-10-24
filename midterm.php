<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search product by category</title>
</head>
<body>
  <form>
    <label for="category">
      <select name="category" id="Category">
<?php
// ทำข้อสอบหลังจาก comment ของแต่ละข้อ

$host = 'db403-mysql';
$user = 'root';
$password = 'P@ssw0rd';
$dbname = 'northwind';
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_errno) {
  die("Connection failed");
}
$conn->close();
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
$start = ($page - 1) * $limit;

$query = "SELECT COUNT(*) AS total FROM categories ";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$totalRecords = $row['total'];

$totalPages = ceil($totalRecords / $limit);
// Query ดึงข้อมูลจากตาราง categories
$query = "SELECT CategoryName,CategoryID
    FROM categories LIMIT $start, $limit";
    $result = $conn->query($query);
if ($result->num_rows > 0) {
  echo '<table class="table">
      <tr>
          <th>CategoryName</th>
          <th>CategoryID</th>
           
      <tr>';
}
while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['CategoryID']}</td>";
    echo "<td>{$row['CategoryName']}</td>";
    echo "</tr>";
}
echo "<table>";


// 3. (5 คะแนน) เพิ่ม element option ใน element select เพื่อแสดงตัวเลือกเป็น CategoryName และค่าที่ได้เป็น CategoryID
// ตัวอย่างการเพิ่ม element options
// <option value="CategoryID">CategoryName</option>

?>
      </select>
    </label>
    <input type="submit" value="Search" name="submit">
  </form>
</body>
</html>