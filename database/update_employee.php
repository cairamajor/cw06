<?php
require "db.php";

$message = "";
$msgClass = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id     = (int)$_POST['emp_id'];
    $name   = trim($_POST['emp_name']);
    $job    = trim($_POST['job_name']);
    $salary = (float)$_POST['salary'];
    $dept   = trim($_POST['department_name']);

    $stmt = $conn->prepare(
        "UPDATE employees
          SET emp_name = ?, job_name = ?, salary = ?, department_name = ?
          WHERE emp_id = ?"
    );
    $stmt->bind_param("ssdsi", $name, $job, $salary, $dept, $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows === 1) {
            $message  = "Success! Employee ID $id has been updated.";
            $msgClass = "success";
        } else {
            $message  = "No changes made. Check the ID exists or values are different.";
            $msgClass = "error";
        }
    } else {
        $message  = "Error: " . $stmt->error;
        $msgClass = "error";
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Employee</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="demo-page">
<div class="demo-shell">
  <div class="demo-card">
    <h2 class="demo-title">Update Employee</h2>
    <p class="demo-subtitle">Edit an existing employee record by ID.</p>

    <form method="POST">
      <div class="demo-grid">

        <div class="demo-field">
          <label>Employee ID </label>
          <input class="demo-input" type="number" name="emp_id" min="1" required>
        </div>

        <div class="demo-field">
          <label>New Name</label>
          <input class="demo-input" type="text" name="emp_name" placeholder="e.g. Ana Lopez" required>
        </div>

        <div class="demo-field">
          <label>New Job Title</label>
          <input class="demo-input" type="text" name="job_name" placeholder="e.g. Developer" required>
        </div>

        <div class="demo-field">
          <label>New Salary</label>
          <input class="demo-input" type="number" step="0.01" name="salary" placeholder="e.g. 75000" required>
        </div>

        <div class="demo-field">
          <label>New Department Name</label>
          <input class="demo-input" type="text" name="department_name" placeholder="e.g. Engineering" required>
        </div>

      </div>

      <div class="demo-actions">
        <button class="demo-btn" type="submit">Update Employee</button>
        <a class="demo-link" href="read_employees.php">View All Employees →</a>
      </div>
    </form>

    <?php if ($message): ?>
      <div class="demo-msg <?= $msgClass ?>">
        <?= htmlspecialchars($message) ?>
      </div>
    <?php endif; ?>
  </div>
</div>
</body>
</html>