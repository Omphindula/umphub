
<footer class="footer">
<div class="footer-left">
  <!-- Text-based Logo -->
  <!-- <a href="feeds.php" class="logo">
    <span class="logo-text">UMP Connect</span>
  </a> -->

 

  <!-- Search Widget -->
  <div id="searchWidget" class="search-widget" style="float:right;">
    <form name="search" action="search.php" method="post">
      <div class="input-group" >
        <input 
          type="text" 
          name="searchtitle" 
          class="form-control" 
          placeholder="Search for..." 
          required
        >
        <button 
          class="btn btn-secondary" 
          style="background-color: #141738; color: white;" 
          type="submit"
        >
          Go!
        </button>
      </div>
    </form>
  </div>
</div>



<div class="footer-right">
  <ul class="nav user-menu">
    <li class="dropdown user-box">
      <a href="#" class="dropdown-toggle user-link" data-toggle="dropdown" aria-expanded="true">
        <img src="./admin/assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle user-img">
      </a>
      <ul class="dropdown-menu dropdown-menu-right user-list" style="background-color:lightgrey;">
        <li>
          <h5>Hello, <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : $fullName; ?>!</h5>
        </li>
        <li>
          <a href="requestPass.php" class="user-action"><i class="ti-settings m-r-5"></i> Change Password</a>
        </li>
        <li>
          <a href="logout.php" class="user-action"><i class="ti-power-off m-r-5"></i> Logout</a>
        </li>
      </ul>
    </li>
  </ul>
</div>

</footer>

<style>
.footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #141738;
  padding: 20px 40px;
  color: #ffffff;
}

/* Footer Navigation */
.footer-left .nav {
  display: flex;
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-left .nav-item {
  margin-right: 25px;
}

.footer-left .nav-link {
  text-decoration: none;
  color: #ffffff;
  font-size: 16px;
  font-weight: 500;
  transition: color 0.3s ease;
}

.footer-left .nav-link:hover {
  color: #61dafb;
}

/* Footer Logo Styling */
.logo-text {
  font-family: 'Roboto', sans-serif;
  font-size: 32px;
  font-weight: 700;
  letter-spacing: 2px;
  color: #ffffff;
  text-transform: uppercase;
  background-image: linear-gradient(to right, #61dafb, #ffffff);
  -webkit-background-clip: text;
  color: transparent;
  transition: transform 0.3s ease, color 0.3s ease;
}

.logo-text:hover {
  transform: scale(1.1);
  color: #61dafb;
}

/* User Menu Styling */
.footer-right .user-menu {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-right .user-box {
  position: relative;
}

.footer-right .user-box img {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  border: 2px solid #ffffff;
}

.footer-right .dropdown-menu {
  right: 0;
  position: absolute;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.footer-right .user-action {
  color: black;
  padding: 10px 15px;
  display: block;
  transition: background-color 0.2s ease;
}

.footer-right .user-action:hover {
  background-color: #e0e0e0;
}
.footer-left {
  text-align: center;
}

.search-widget {
  margin: 20px auto;
  display: flex;
  justify-content: center;
  float: center;
}

.input-group {
  max-width: 500px; /* Adjust as needed */
  width: 100%;
}

.form-control {
  width: 100%; /* Ensure the input takes up the available space */
}

.btn {
  margin-left: 10px; /* Space between input and button */
}
</style>
