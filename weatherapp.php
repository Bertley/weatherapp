<?php
    include 'Shared/header.php';
?>

<div class="container">

  <div id="search-box">
      <h1>Bertley Weather and Maps</h1>

      <form action="weatherdetails.php" method="get">
          <div class="form-group">
              <label for="city">Enter the name of a city.</label>
              <input type="text" class="form-control" id="city" name="city" aria-describedby="city" placeholder="E.g. New York, Tokyo">
          </div>
          <div class="pt-2">
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>
      </form>
  </div>

</div>

<?php
    include 'Shared/footer.php';
?>