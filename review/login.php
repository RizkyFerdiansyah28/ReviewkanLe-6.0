<?php 
session_start();

include('layout/header-guest.php');

// Check if the login form is submitted
if (isset($_POST['login'])) {
    // Check if email and password are posted
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Escape email and password inputs to prevent SQL injection
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        
        // Query to check if the user exists
        $result = mysqli_query($db, "SELECT * FROM users WHERE email = '$email'");
        
        // Check if the user is found
        if (mysqli_num_rows($result) == 1) {
            $hasil = mysqli_fetch_assoc($result);
            
            // Verify the password
            if(password_verify($password, $hasil['password'])){
                // Set session variables on successful login
                $_SESSION['login'] = true;
                $_SESSION['user_id'] =  $hasil['user_id'];
                $_SESSION['username'] =  $hasil['username'];
                $_SESSION['email'] =  $hasil['email'];

                // Redirect to the review page
                header("Location: daftar-review.php");
                exit;
            } else {
                // Password is incorrect
                $error = true;
            }
        } else {
            // No user found
            $error = true;
        }
    }
}
?>

<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-12 col-sm-8 col-md-6 m-auto">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">Login</h1>
                    <?php if (isset($error)) : ?>
                    <script>
                    alert('gagal')
                    </script>;
                    <?php endif; ?>
                    <form action="" method="POST">
                        <input type="email" name="email" class="form-control my-3 py-2" placeholder="Email" required />
                        <input type="password" name="password" class="form-control my-3 py-2" placeholder="Password"
                            required />
                        <div class="text-center mt-3">
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                    <a href="register.php" class="nav-link text-primary text-center text-py-10">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
</div>