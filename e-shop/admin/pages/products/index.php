<?php
$included_files = get_included_files();
$included = false;

foreach ($included_files as $file) {
  $file_name = basename($file);
  if ($file_name == 'config.php') {
    $included = true;
    break;
  }
}

if (!$included) {
  include './../../config.php';
}

?>



<?php include "./../../shared/header.php"; ?>

<div class="row" style="margin-top: 5rem;">

  <div class="card">
    <div class="card-body">
      <h4 class="card-title">All products</h4>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="order-listing" class="table">
              <thead>
                <tr>
                  <th>ID #</th>
                  <th>Name</th>
                  <th>Brand</th>
                  <th>Category #</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Stars</th>
                  <th>Type</th>
                  <th>Added at</th>
                  <th>Updated at</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Product one</td>
                  <td>Brand one</td>
                  <td>2</td>
                  <td>$170</td>
                  <td>350</td>
                  <td>5</td>
                  <td>Product</td>
                  <td>10-10-2023</td>
                  <td>10-10-2023</td>
                  <td>
                    <button class="btn btn-outline-primary">Actions</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>


<?php include "./../../shared/footer.php"; ?>