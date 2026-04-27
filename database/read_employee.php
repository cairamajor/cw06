<?php
require "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Read Employees</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="demo-page">
<div class="demo-shell">
  <div class="demo-card">
    <h2 class="demo-title">All Employees</h2>
    <p class="demo-subtitle">Live records pulled from the database.</p>

    <?php
    $result = $conn->query("SELECT * FROM employees ORDER BY emp_id ASC");
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Job</th><th>Salary</th><th>Hire Date</th><th>Department</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['emp_id'])         . "</td>";
            echo "<td>" . htmlspecialchars($row['emp_name'])        . "</td>";
            echo "<td>" . htmlspecialchars($row['job_name'])        . "</td>";
            echo "<td>$" . htmlspecialchars($row['salary'])         . "</td>";
            echo "<td>" . htmlspecialchars($row['hire_date'])       . "</td>";
            echo "<td>" . htmlspecialchars($row['department_name']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No employees found.</p>";
    }
    $conn->close();
    ?>

    <div class="demo-actions" style="margin-top:1rem;">
      <a class="demo-link" href="employee_demo.php">← Add Employee</a>
      <a class="demo-link" href="update_employee.php">Edit an Employee →</a>
      <a class="demo-link" href="delete_employee.php">Delete an Employee →</a>
    </div>
  </div>
</div>
</body>
</html>