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
      <select name="category" id="category">
<?php
// ทำข้อสอบหลังจาก comment ของแต่ละข้อ
$servername = "db403-mysql";
$database = "northwind";
$username = "root";
$password = "P@ssw0rd";
// $conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_errno) {
  die("Connection failed");
}
echo "Connected successfully";
$conn->close();

// 2. $sql = "SELECT * FROM categories";
$result = $conn->query($sql);
echo "<table>";
while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['CategoryID']}</td>";
    echo "<td>{$row['CategoryName']}</td>";
    echo "</tr>";
}
echo "</table>";


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