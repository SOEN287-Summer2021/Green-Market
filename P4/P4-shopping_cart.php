<?php
    session_id("1");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Green Market</title>
  <meta charset="utf-8" name="viewport" content="width = device-width, initial-scale = 1" />
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" />
  <!-- install Bootstrap 4 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <!-- Custom Stylesheets -->
  <link href="../stylesheet.css" rel="stylesheet" />
  <link href="../P4-style.css" rel="stylesheet" />
</head>

<body>
  <div id="page-container">
    <div id="content-wrap">
      <header>
        <div class="header-1">
          <!-- facebook and instagram shortcut logos -->
          <div class="follow">
            <a href="#" class="fab fa-facebook" style="font-size: 24px"></a>
            <a href="#" class="fab fa-instagram" style="font-size: 24px"></a>
          </div>
        </div>

        <div class="header-2">
          <!-- main carrot logo and search bar -->
          <a href="../index.html" class="logo">
            <i class="fas fa-carrot" id="favicon"></i><img src="../green_market-logo.png" id="market-name">
          </a>
          <a href="../index.html" class="logo" id="title">
            <i class="fas fa-carrot" id="favicon"></i>
          </a>

          <div class="searching-container">
            <form onsubmit="return search()" class="search-bar-container">
              <input type="text" id="search-bar" placeholder="Search product">
              <a href="#" class="fas fa-search">
              </a>
            </form>
          </div>
        </div>

        <div class="nav">
          <!-- menu bars -->

          <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="container-fluid">
              <a class="navbar-brand" href="#"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../index.html">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../P2-P3/aisles.html">Aisles</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../extra/deals.html">Deals</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../extra/services.html" tabindex="-1" aria-disabled="true">Services</a>
                  </li>
                </ul>
              </div>
              <span id="shopping-cart"><a href="P4-shopping_cart.php" class="fas fa-shopping-cart"
                  id="shopping-cart"></a></span>
              <span id="user-login"><a href="../P5/P5-login.html" class="fas fa-user"></a></span>
            </div>
          </nav>
        </div>
      </header>
      <!-- P4 shopping cart section starts -->


      <div class="shopping-cart-title" style="overflow:hidden; white-space:nowrap;margin:1%">
        <h2>Shopping Cart
          <hr style="display:inline-block; width: 100%;" />
        </h2>
      </div>
      <section class="product" id="product">
        <div class="box-container-sc">
          <form id="scform" method="post" action="save_cart.php">
            <?php include "P4-shopping_cartphp.php"?>
          </form>
        </div>
        <div class="overviewprice-box">
          <div class="overviewprice">
            <form id="form-payment" action="add_order.php" method="post">
              <p><b>Total(w/o tax):</b> <span id="totalwotax"></span></p>
              <p><b>GST/HST:</b> <span id="gst"></span></p>
              <hr />
              <p><b>Total:</b> <span id="total"></span></p>
              <input type="hidden" name="total" id="totalinput">
              <input type="button" id="payment" name="payment" value="Order">
              <!-- <input type = "submit" id = "" name = "" value = "submit"> -->
            </form>
          </div>
        </div>
      </section>
    </div>
    <!-- shopping cart section ends -->

    <!-- common footer section starts-->
    <section class="footer">
      <hr class="solid">
      <div class="box-container">
        <div class="box">
          <p id="title-footer" id="link">Quick links</p>
          <p><a href="../index.html" id="link">Home</a></p>
          <p><a href="../extra/about.html" id="link">About us</a></p>
          <p><a href="../extra/contact.html" id="link">Contact</a></p>
        </div>

        <div class="box">
          <p id="title-footer">Follow us:</p>
          <p><a href="../https://facebook.com" id="link">Facebook</a></p>
          <p><a href="../https://instagram.com" id="link">Instagram</a></p>
        </div>
      </div>
      <footer class="copyright">
        <p>Concordia University, SOEN 287 Project © Team Green, 2021</p>
      </footer>
    </section>
  </div>
  <!-- Install JavaScrip plugins and Popper -->
  <script src="../extra/search.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script>
    function calculateTotalOnLoad() {
          var totalWOTax = 0;
          var tax = 0;
          var total = 0;
          if (document.getElementsByName("productq") != null) {
            var product = document.getElementsByName("productq");
            <?php
            foreach ($keys as $key) {
              $quantity = $_SESSION["$key"];
              $price;
              foreach ($products as $product) {
                if ($product->product_number == $key) {
                  $price = $product->price;
                  break;
                }
              }
              echo "totalWOTax = parseFloat(totalWOTax) + parseFloat($quantity) * parseFloat($price);";
            }
            ?>
            tax = totalWOTax * 0.05;
            total = tax + totalWOTax;
            document.getElementById("totalwotax").innerHTML = "$" + totalWOTax.toFixed(2);
            document.getElementById("gst").innerHTML = "$" + tax.toFixed(2);
            document.getElementById("total").innerHTML = "$" + total.toFixed(2);
            document.getElementById("totalinput").value = total.toFixed(2);
          } else {
            document.getElementById("totalwotax").innerHTML = "$0.00";
            document.getElementById("gst").innerHTML = "$0.00";
            document.getElementById("total").innerHTML = "$0.00";
            document.getElementById("totalinput").value = 0;
          }
        }

        function checkUser() {

          <?php
          if (session_id() == "0") {
            echo "alert(\"You must be logged in to place an order\")";
          } else if (count($_SESSION) == 0) {
            echo "alert(\"Cart Empty\");";
          } else {
            echo "document.getElementById(\"form-payment\").submit();";
          }
          ?>
        }
        var qButtons = document.getElementsByName("productq[]");
        <?php
        for ($i = 0; $i < count($_SESSION); $i++) {
          echo "qButtons[$i].onchange = calculateTotal;";
        }
        ?>

        function calculateTotal() {
          // document.getElementById("total").innerHTML = "textcalc";
          // var totalWOTax = 0;
          // var tax = 0;
          // var total = 0;
          // var productq = document.getElementsByName("productq[]");
          // var price = document.getElementsByName("price[]");
          // for (var i = 0; i < productq.length; i++){
          //     totalWOTax = parseFloat(totalWOTax) + parseFloat(productq[i].value) * parseFloat(price[i].value);
          // }
          // tax = totalWOTax * 0.05;
          // total = tax + totalWOTax;
          // document.getElementById("totalwotax").innerHTML = "$" + totalWOTax.toFixed(2);
          // document.getElementById("gst").innerHTML = "$" + tax.toFixed(2);
          // document.getElementById("total").innerHTML = "$" + total.toFixed(2);
          saveChanges();
        }

        function saveChanges() {
          var x = document.getElementById("scform").submit();
          return null;
        }
        // qButtons[0].onchange = calculateTotal;

        

        var plusButtons = document.getElementsByName("plus");
        <?php
        for ($i = 0; $i < count($_SESSION); $i++) {
          echo "plusButtons[$i].onclick = function (){qButtons[$i].value = parseInt(qButtons[$i].value) + 1;saveChanges()};";
        }
        ?>
        var minusButtons = document.getElementsByName("minus");
        <?php
        for ($i = 0; $i < count($_SESSION); $i++) {
          echo "minusButtons[$i].onclick = function (){if(qButtons[$i].value != 0){qButtons[$i].value = parseInt(qButtons[$i].value) - 1;saveChanges()}};";
        }
        ?>

        document.getElementById("payment").addEventListener("click", checkUser);
        window.addEventListener("load", calculateTotalOnLoad);
  </script>
</body>

</html>