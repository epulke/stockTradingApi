<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Tasks</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<section class="vh-100" style="background-image: url('https://lh3.googleusercontent.com/proxy/6WiXKlxiaHF2cMqwXQSN4w6aSrSaEclkVv-qYblLHJxGT0tbamjN4vgn-UqCyQUelR-g8Z0cvjsF_L1Fue3BO_R76Q1ZfEF7zB4lWPKOjHvzbCiW4T7USDY-jq77a0bKpgNifkUAZQ')">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-start h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">

                            {% block content %}
                            <nav class="navbar navbar-expand-lg navbar-light">
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class="navbar-nav">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="/register">Register</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/products">Products</a>
                                        </li>
                                        <li class="nav-item">
                                            {% if user is empty %}
                                            <a class="nav-link" href="/login">Login</a>
                                            {% else %}
                                            <a class="nav-link" href="/user">  </a>
                                            {% endif %}
                                        </li>
                                    </ul>
                                </div>
                            </nav>

                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Register</p>
                                <p class="text-center ">
                                <form class="mx-1 mx-md-4 needs-validation" method="post" action="">

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="name" name="name" class="form-control" required/>
                                            <label class="form-label" for="name">Your Name</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="email" id="email" name="email" class="form-control" required/>
                                            <label class="form-label" for="email">Your Email</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" id="password" name="password" class="form-control" required/>
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" id="password_confirm" name="password_confirm" class="form-control" required/>
                                            <label class="form-label" for="password_confirm">Repeat your password</label>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <input type="submit" id="register" name="register" class="btn btn-primary btn-lg" value="Register"/>
                                    </div>

                                </form>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</section>
</html>
