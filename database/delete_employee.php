<?php
require "db.php";

$message = "";
$msgClass = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['emp_id'];

    $stmt = $conn->prepare("DELETE FROM employees WHERE emp_id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows === 1) {
            $message = "Success! Employee ID $id has been deleted.";
            $msgClass = "success";
        } else {
            $message = "No rows deleted. Employee ID $id not found.";
            $msgClass = "error";
        }
    } else {
        $message = "Error: " . $stmt->error;
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
  <title>Delete Employee</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="demo-page">
<div class="demo-shell">
  <div class="demo-card">
    <h2 class="demo-title">Delete Employee</h2>
    <p class="demo-subtitle">Enter an employee ID to remove them from the database.</p>

    <form method="POST">
      <div class="demo-field">
        <label>Employee ID</label>
        <input class="demo-input" type="number" name="emp_id" min="1" required>
      </div>
      <div class="demo-actions">
        <button class="demo-btn" type="submit">Delete Employee</button>
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