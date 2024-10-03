<?php
$conn= new mysqli(
        'db403-mysql',
        'root',
        'P@ssw0rd',
        'northwind');
if ($conn->errno){
    die($conn->connect_error);
}        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Pagination</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
<?php
// กำหนดจำนวนรายการต่อหน้า
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
$start = ($page - 1) * $limit;

$query = "SELECT COUNT(*) AS total FROM products";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$totalRecords = $row['total'];

// คำนวณจำนวนหน้า
$totalPages = ceil($totalRecords / $limit);
// Query ดึงข้อมูลจากตาราง products
$query = "SELECT ProductID, ProductName, UnitPrice
    FROM products LIMIT $start, $limit";
    $result = $conn->query($query);

// แสดงข้อมูล
if ($result->num_rows > 0) {
    echo '<table class="table">
        <tr>
            <th>ProductID</th>
            <th>ProductName</th>
             <th>ProductPrice</th>
        <tr>';
    while($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo "<td>{$row['ProductID']}</td>";
    echo "<td>{$row['ProductName']}</td>";
    echo "<td>{$row['UnitPrice']}</td>";
    echo '</tr>';
    }
    echo'</table>';
} else {
    echo "No records found.";
}
?>
<nav>
  <ul class="pagination">
    <?php if($page > 1): ?>
      <li class="page-item">
        <a class="page-link" href="?page=<?php echo $page-1; ?>&limit=<?php echo $limit; ?>">Previous</a>
      </li>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <li class="page-item <?php if($page == $i) echo 'active'; ?>">
        <a class="page-link" href="?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>"><?php echo $i; ?></a>
      </li>
    <?php endfor; ?>

    <?php if($page < $totalPages): ?>
      <li class="page-item">
        <a class="page-link" href="?page=<?php echo $page+1; ?>&limit=<?php echo $limit; ?>">Next</a>
      </li>
    <?php endif; ?>
  </ul>
</nav>
<?php
$conn->close();
?>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>