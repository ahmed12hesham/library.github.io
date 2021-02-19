<?php
  include 'layout/include/header.php';
  $search = '%' . $_GET['search'] . '%';

// Check If There Is A Get Request Variable
    if(empty($_GET['search'])) {
      // Return To Category Page If It Is Not Exist
      header('Location: index.php');
      exit();
    }
?>
<!-- Start Banner  -->
<div class="banar">
  <div class="overlay"></div>
  <div class="lib-info text-center">
    <h4>حمّل عشرات الكتب مجاناً </h4>
    <p>من أجل نشر المعرفة والثقافة، وغرس حب القراءة بين المتحدثين باللغة العربية</p>
  </div>
</div>
<!-- End Banner -->
<div class="books">
  <div class="container">
    <div class="row">
        <?php
        // Check For Page Get Request
        if(isset($_GET['page'])) {
          $page = $_GET['page'];
        } else {
          $page = 1;
        }
        // Limit For Books In The Main Page
        $limit = 9;
        $start = ($page - 1) * $limit;
        $query = "SELECT * FROM books WHERE bookTitle LIKE '$search' OR bookAuthor LIKE '$search' OR bookCat LIKE '$search'";
        $result = mysqli_query($con, $query);
        // Loop Through Books
        if(mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-md-6 col-lg-4">
              <div class="card text-center">
                <div class="img-cover">
                  <img src="uploads/bookCovers/<?php echo $row['bookCover']; ?>" alt="Book Cover" class="card-img-top">
                </div>
                <div class="card-body">
                  <h4 class="card-title">
                    <a
                      href="book.php?id=<?php echo $row['id']; ?>&&category=<?php echo $row['bookCat']; ?>"><?php echo $row['bookTitle']; ?></a>
                  </h4>
                  <p class="card-text"><?php echo mb_substr($row['bookContent'], 0, 150, "UTF-8") . ' ...'; ?></p>
                  <a href="book.php?id=<?php echo $row['id']; ?>&&category=<?php echo $row['bookCat']; ?>">
                    <button class="custom-btn">عرض الكتاب</button>
                  </a>
                </div>
              </div>
            </div>
            <?php
          }
        } else {
          ?>
          <div class="text-center">لاتوجد أي كتب</div>
          <?php
        }
      ?>
    </div>

      
    </div>
</div>
<?php
  include 'layout/include/footer.php';
?>