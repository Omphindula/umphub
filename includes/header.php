<footer class="footer">
  <div class="footer-left">
    <a href="feeds.php" class="logo">
      /<img src="images/logo.jpg" height="50"  alt="UMP Hub Logo">
    </a>
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="feeds.php">Home</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="feeds.php">Feeds</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about-us.php">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact-us.php">Contact us</a>
      </li>
    </ul>
  </div>

  <div class="footer-right">
    <ul class="nav user-menu" >
      <li class="dropdown user-box" >
        <a href="#" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true" >
          <img src="./admin/assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle user-img">
        </a>
        <ul class="" style=background-color:lightgrey;>
          <li>
            <h5>Hi, bro</h5>
          </li>
          <li>
            <a href="change-password.php" style=color:black;><i class="ti-settings m-r-5"></i> Change Password</a>
          </li>
          <li>
            <a href="logout.php" style=color:black;><i class="ti-power-off m-r-5"></i> Logout</a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</footer>
<style>/* General Footer Styles */
.footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #141738;
  padding: 20px 30px;
  color: #ffffff;
}

.footer a {
  color: #ffffff;
  text-decoration: none;
  transition: all 0.3s ease;
}

.footer a:hover {
  text-decoration: underline;
}

/* Left section: Logo and Navigation */
.footer-left {
  display: flex;
  align-items: center;
}

.footer-left .logo {
  margin-right: 50px;
}

.footer-left .nav {
  display: flex;
  gap: 15px; /* Space between nav items */
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-left .nav-item {
  display: inline-block;
}

/* Right section: User Menu */
.footer-right {
  display: flex;
  align-items: center;
}

.footer-right .user-menu {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-right .user-box {
  position: relative;
}

.footer-right .user-box img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
}

.footer-right .dropdown-menu {
  right: 0;
  position: absolute;
}
</style>