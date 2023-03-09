<?php include './config.php'; ?>

<?php

if (!isset($_SESSION['admin']) && $_SESSION['admin'] !== 'true') {

  header('Location: ./../user');
  exit;
}

?>

<?php $conn = include './../db.php'; ?>

<!-- Registered users -->
<?php
$sql = <<<SQL
  SELECT COUNT(*) AS Total_Users
  FROM users
  WHERE type = 0
SQL;

$total_users = $conn->query($sql)->fetch_assoc();
?>


<!-- Total products -->
<?php
$sql = <<<SQL
  SELECT COUNT(*) AS Total_products
  FROM products
SQL;

$total_products = $conn->query($sql)->fetch_assoc();
?>

<!-- Total categories -->
<?php
$sql = <<<SQL
SELECT COUNT(*) AS Total_Categories
FROM categories
SQL;

$total_categories = $conn->query($sql)->fetch_assoc();
?>

<!-- Total admins -->
<?php
$sql = <<<SQL
SELECT COUNT(*) AS Total_Orders
FROM orders
SQL;

$total_orders = $conn->query($sql)->fetch_assoc();
?>

<!-- To do list -->
<?php
$id = $_SESSION['id'];
$sql = <<<SQL
SELECT *
FROM todos
WHERE id = $id
SQL;

$todos = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);

// echo '<pre>';
// var_dump($todos);
// die;

?>

<?php include './shared/header.php' ?>

<div class="row" style="margin-top: 5rem;">
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-9">
            <div class="d-flex align-items-center align-self-start">
              <h3 class="mb-0">
                <?= $total_users['Total_Users']  ?>
              </h3>
            </div>
          </div>
        </div>
        <h6 class="text-muted font-weight-normal">Registered users</h6>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-9">
            <div class="d-flex align-items-center align-self-start">
              <h3 class="mb-0">
                <?= $total_products['Total_products'] ?>
              </h3>
            </div>
          </div>
        </div>
        <h6 class="text-muted font-weight-normal">Products</h6>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-9">
            <div class="d-flex align-items-center align-self-start">
              <h3 class="mb-0">
                <?= $total_categories['Total_Categories'] ?>
              </h3>
            </div>
          </div>
        </div>
        <h6 class="text-muted font-weight-normal">Categories</h6>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-9">
            <div class="d-flex align-items-center align-self-start">
              <h3 class="mb-0">
                <?= $total_orders['Total_Orders'] ?>
              </h3>
            </div>
          </div>
        </div>
        <h6 class="text-muted font-weight-normal">Total orders</h6>
      </div>
    </div>
  </div>
</div>

<div class="row">

  <div class="col-12 col-md-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Revenu History</h4>
        <canvas id="transaction-history" class="transaction-chart"></canvas>
        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
          <div class="text-md-center text-xl-left">
            <h6 class="mb-1">Revenue this month</h6>
          </div>
          <div class="align-self-center flex-grow text-end text-md-center text-xl-right py-md-2 py-xl-0">
            <h6 class="font-weight-bold mb-0">$236</h6>
          </div>
        </div>
        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
          <div class="text-md-center text-xl-left">
            <h6 class="mb-1">Revenue last month</h6>
          </div>
          <div class="align-self-center flex-grow text-end text-md-center text-xl-right py-md-2 py-xl-0">
            <h6 class="font-weight-bold mb-0">$593</h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12 col-xl-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">To do list</h4>
        <form method="POST" class="add-items d-flex">
          <input type="text" name="task" class="form-control todo-list-input" placeholder="Enter task..">
          <button type="submit" class="add btn btn-primary todo-list-add-btn">Add</button>
        </form>

        <?php if ($todos) : ?>
          <div class="list-wrapper">
            <ul class="d-flex flex-column-reverse text-white todo-list todo-list-custom">
              <?php foreach ($todos as $task) : ?>
                <li class="<?= $task['status'] ? 'completed' : '' ?> task" data-id="<?= $task['id'] ?>">
                  <div class="form-check form-check-primary">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" <?= $task['status'] ? 'checked' : '' ?>> <?= $task['task'] ?> </label>
                  </div>
                  <i class="remove mdi mdi-close-box"></i>
                </li>
              <?php endforeach ?>
            </ul>
          </div>
        <?php endif ?>
      </div>
    </div>
  </div>

</div>

<script>
  // Add event listeners to each task checkbox and label element
  const checkboxes = document.querySelectorAll(' .checkbox');
  const labels = document.querySelectorAll('.form-check-label');
  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('click', toggleTaskStatus);
  });
  labels.forEach(label => {
    label.addEventListener('click', toggleTaskStatus);
  });

  function toggleTaskStatus() {
    // Get the task ID from the parent LI element
    const taskId = this.closest('li').dataset.id;

    // Toggle the "completed" class on the parent LI element
    const taskElement = this.closest('li');
    taskElement.classList.toggle('completed');

    // Get the new status of the task ("completed" or "not completed")
    const isCompleted = taskElement.classList.contains('completed') ? 1 : 0;

    // Send an AJAX request to the server to save the updated task status
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'update-task-status.php');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      console.log(xhr.responseText);
    };
    xhr.send("id=" + taskId + "&status=" + isCompleted + "&user_id=<?= $_SESSION['id']; ?>");
  }
</script>

<?php include './shared/footer.php'; ?>