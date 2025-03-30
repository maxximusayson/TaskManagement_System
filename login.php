<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
ob_start();

// Load system settings into session
$system = $conn->query("SELECT * FROM system_settings")->fetch_array();
foreach($system as $k => $v){
  $_SESSION['system'][$k] = $v;
}
ob_end_flush();

// Redirect if already logged in
if(isset($_SESSION['login_id']))
  header("location:index.php?page=home");
?>

<?php include 'header.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BGC Corporation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
          body {
            font-family: 'Century Gothic', sans-serif;
            background: linear-gradient(to bottom, #004A7C, #002744);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 250px; 
        }
        .login-container {
            max-width: 400px;
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 12px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            color: white;
            text-align: center;
        }
        .logo {
            max-width: 100px;
            margin: 0 auto 15px;
            display: block;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .input-group-text {
            background: transparent;
            border: none;
            color: white;
        }
        .form-control {
            background: transparent;
            border: none;
            border-bottom: 2px solid white;
            color: white;
        }
        .form-control:focus {
            background: transparent;
            box-shadow: none;
            border-bottom: 2px solid #00c6ff;
        }
        .btn-primary {
            background: #00c6ff;
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background: #0072ff;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">
<div class="login-container">
        <img src="assets/images/pics/logo.png" alt="BGC Corporation Logo" class="logo">
        <h2 class="fw-bold">BGC Corporation</h2>
        <p class="mb-4">Sign in to your account</p>
        <form action="" id="login-form">
            <div class="mb-3 text-start">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" name="email" required placeholder="Enter your email">
                </div>
            </div>
            <div class="mb-3 text-start">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" name="password" required placeholder="Enter your password">
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label for="remember" class="form-check-label">Remember Me</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign In</button>
        </form>
    </div>

    <script>
        document.getElementById("login-form").addEventListener("submit", function(event) {
            event.preventDefault();
            const email = document.querySelector("input[name='email']").value;
            const password = document.querySelector("input[name='password']").value;

            if (email.trim() === "" || password.trim() === "") {
                alert("Please fill in all fields.");
                return;
            }

            // Simulate login process
            console.log("Logging in with:", email, password);
            alert("Login successful (Simulated)");
        });
    </script>
</body>
</html>


  <script>
    $(document).ready(function(){
      $('#login-form').submit(function(e){
        e.preventDefault();
        start_load();
        if($(this).find('.alert-danger').length > 0 )
          $(this).find('.alert-danger').remove();
        $.ajax({
          url:'ajax.php?action=login',
          method:'POST',
          data:$(this).serialize(),
          error:err=>{
            console.log(err);
            end_load();
          },
          success:function(resp){
            if(resp == 1){
              location.href ='index.php?page=home';
            }else{
              $('#login-form').prepend('<div class="alert alert-danger mt-2">Username or password is incorrect.</div>');
              end_load();
            }
          }
        })
      })
    })
  </script>

<?php include 'footer.php' ?>
</body>
</html>
