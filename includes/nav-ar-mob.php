<header class="main-header">
  <nav class="navbar navbar-static-top">
    <div class="container">



      <!-- Navbar Left Menu -->
      <div class="navbar-custom-menu" style="float: left ;font-size: 17px;">

                 <ul class="nav navbar-nav" style="float: right;">
          <li style="float: right;"><a href="index.php" style=""><?php echo $lang['home'] ?></a></li>
          <li style="float: right;"><a href=""><?php echo $lang['about us'] ?></a></li>
          <li style="float: right;"><a href="contact_us-ar.php"><?php echo $lang['contact us'] ?></a></li>

          <li class="dropdown messages-menu" style="float: right;">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-shopping-cart"></i>
              <span class="label label-success cart_count"></span>
            </a>
            <ul class="dropdown-menu"  dir="rtl">
              <li class="header" style="text-align: right;">لديك <span class="cart_count"></span>صنف فى السلة</li>
              <li>
                <ul class="menu" id="cart_menu">
                </ul>
              </li>
              <li class="footer"><a href="cart_view.php">اذهب لسلة المشتريات</a></li>
            </ul>
          </li>
          <?php 
            if(isset($_SESSION['lang']))
            {
              if ($_SESSION['lang']=="en") {
                $lang_change="ar";
              }
              else if($_SESSION['lang']=="ar")
              {
                $lang_change="en";                
              }
            }
          ?>
          <li style="float: right;"><a href='index.php?lang=<?php echo $lang_change?>'><?php echo $lang['language'] ?></a></li>
        </ul> 


        <ul class="nav navbar-nav" style="float: right;">



                    <li class="dropdown" style="float: right;" dir="rtl">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $lang['category'] ?><span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu" dir="rtl" style="text-align: right;font-size: 17px; background-color: black">
              <li style="margin-right: 5px;margin-left: 5px;"><form method="POST" class="navbar-form navbar-left" action="search.php">
          <div class="input-group">
              <input type="text" class="forightrm-control" id="" name="keyword" placeholder="ابحث عن منتج" required style="text-align: right;">
              <span class="input-group-btn" id="searchBtn" style="display:none;">
                  <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search"></i> </button>
              </span>
          </div>
        </form></li> 
              <?php
             
                $conn = $pdo->open();
                try{
                  $stmt = $conn->prepare("SELECT * FROM category");
                  $stmt->execute();
                  foreach($stmt as $row){
                    echo "
                      <li><a href='category.php?category=".$row['cat_slug']."'>".$row['ar-name']."</a></li>
                    ";                  
                  }
                }
                catch(PDOException $e){
                  echo "There is some problem in connection: " . $e->getMessage();
                }

                $pdo->close();

              ?>
            </ul>
          </li>


          <?php
            if(isset($_SESSION['user'])){
              $image = (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg';
              echo '
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="'.$image.'" class="user-image" alt="User Image">
                    <span class="hidden-xs">'.$user['firstname'].' '.$user['lastname'].'</span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                      <img src="'.$image.'" class="img-circle" alt="User Image">

                      <p>
                        '.$user['firstname'].' '.$user['lastname'].'
                        <small>Member since '.date('M. Y', strtotime($user['created_on'])).'</small>
                      </p>
                    </li>
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                      </div>
                      <div class="pull-right">
                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                      </div>
                    </li>
                  </ul>
                </li>
              ';
            }
            else{
              echo "
                <li style='float: right;'><a href='login-ar.php'>".$lang['login']."</a></li>
                <li style='float: right;'><a href='signup-ar.php'>".$lang['sign up']."</a></li>
              ";
            }
          ?>


        </ul>
       
      </div>
   
    </div>
  </nav>
</header>