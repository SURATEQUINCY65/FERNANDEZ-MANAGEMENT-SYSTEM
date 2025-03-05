<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        .notification-count {
            position: absolute;
            top: -5px;
            right: -10px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 2px 5px;
            font-size: 12px;
        }
        .topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 13px;
}

.topnav a:hover {
  background-color: #ddd;
  color: whitesmoke;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}

    </style>
</head>
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
  
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn" data-wow-delay="0.1s">
    <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <img src="img/logo.jpg" alt="Logo" class="me-2" style="width: 70px; height: auto;"> <!-- Adjust the path and size as needed -->
        <h1 class="m-0 text-primary">V&C FERNANDEZ OPTICAL<i class="logo"></i></h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
        <div class="topnav">
  <a href="index.php">Home</a>
  <a href="contact.php">Contact</a>
  <a class="active" href="">Service</a>
  <a href="http://localhost/shop/index.php">Shop</a>
  <a href="about.php">About</a>
</div>

<div style="padding-right:16px">
</div>
        </div>
</nav>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <!-- Page Header End -->
 

    <!-- Service Start -->
    <div class="container-xxl py-5" style="background-image: url('img/image_21.jfif'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="text-center mb-5" data-wow-delay="0.1s" style="max-width: 900px;">
        <h1 class="text-white">V&C Fernandez Optical services are primarily focused on:</h1>
<ol class="text-white">
    <li>Eye Refraction: Measuring vision accuracy to determine the correct prescription for glasses or contact lenses.</li>
    <li>Prescription of Eyeglasses & Contact Lenses: Recommending corrective lenses based on the refraction test.</li>
    <li>Dispensing Eyeglasses & Contact Lenses: Providing the correct lenses and ensuring proper fit and comfort.</li>
</ol>
<h1 class="text-white">Explore Our Range of Lenses</h1>
<p class="text-white">From corrective to decorative, we have the perfect lenses for your needs.</p>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="icon mb-3" style="width: 65px; height: 65px; background: url('img/corrective-icon.png') no-repeat center; background-size: contain;"></div>
                        <h4 class="mb-3">Corrective Lenses</h4>
                        <button class="btn btn-success rounded-pill py-3 px-5 mt-3" onclick="openModal('modal1')">Learn More</button>
                        <p class="mt-3">Enhance your vision with our range of corrective lenses tailored to your needs.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="icon mb-3" style="width: 65px; height: 65px; background: url('img/contact-icon.png') no-repeat center; background-size: contain;"></div>
                        <h4 class="mb-3">Contact Lenses</h4>
                        <button class="btn btn-success rounded-pill py-3 px-5 mt-3" onclick="openModal('modal2')">Learn More</button>
                        <p class="mt-3">Discover the comfort and convenience of our high-quality contact lenses.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="icon mb-3" style="width: 65px; height: 65px; background: url('img/specialty-icon.png') no-repeat center; background-size: contain;"></div>
                        <h4 class="mb-3">Specialty Lenses</h4>
                        <button class="btn btn-success rounded-pill py-3 px-5 mt-3" onclick="openModal('modal3')">Learn More</button>
                        <p class="mt-3">Custom-made lenses designed to meet your unique vision needs.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="icon mb-3" style="width: 65px; height: 65px; background: url('img/cosmetic-icon.png') no-repeat center; background-size: contain;"></div>
                        <h4 class="mb-3">Cosmetic Lenses</h4>
                        <button class="btn btn-success rounded-pill py-3 px-5 mt-3" onclick="openModal('modal4')">Learn More</button>
                        <p class="mt-3">Transform your look with our stylish cosmetic lenses.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="icon mb-3" style="width: 65px; height: 65px; background: url('img/protective-icon.png') no-repeat center; background-size: contain;"></div>
                        <h4 class="mb-3">Protective Lenses</h4>
                        <button class="btn btn-success rounded-pill py-3 px-5 mt-3" onclick="openModal('modal5')">Learn More</button>
                        <p class="mt-3">Keep your eyes safe with our durable protective lenses.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('modal1')">&times;</span>
        <h2>Corrective Lenses</h2>
        <img src="img/Corrective Lenses copy.jpg" width="300px" alt="Corrective Lenses">
        <p>Corrective lenses are designed to improve vision by compensating for refractive errors. They can be in the form of glasses or contact lenses, addressing issues like myopia, hyperopia, and astigmatism.</p>
    </div>
</div>
<div id="modal2" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('modal2')">&times;</span>
        <h2>Contact Lenses</h2>
        <img src="img/Contact Lenses.jpg" width="300px" alt="Contact Lenses">
        <p>Contact lenses are a popular alternative to glasses, providing a wider field of vision and greater comfort. They are available in various types, including daily disposables and extended wear.</p>
    </div>
</div>
<div id="modal3" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('modal3')">&times;</span>
        <h2>Specialty Lenses</h2>
        <img src="img/specialty.jpg" width="300px" alt="Specialty Lenses">
        <p>Specialty lenses are tailored for specific vision needs, such as keratoconus or presbyopia. They offer unique designs and materials to ensure optimal comfort and vision correction.</p>
    </div>
</div>
<div id="modal4" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('modal4')">&times;</span>
        <h2>Cosmetic Lenses</h2>
        <img src="img/Cosmetics or Decorative Lenses.jpg" width="300px" alt="Cosmetic Lenses">
        <p>Cosmetic lenses can change the color of your eyes or enhance your natural look. They are available in various styles, including theatrical and colored lenses.</p>
    </div>
</div>
<div id="modal5" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('modal5')">&times;</span>
        <h2>Protective Lenses</h2>
        <img src="img/Protective Lenses.jpg" width="300px" alt="Protective Lenses">
        <p>Protective lenses are designed to shield your eyes from harmful elements. They are essential for safety in various environments, providing impact resistance and UV protection.</p>
    </div>
</div>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.7);
    }
    .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
        border-radius: 8px;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).style.display = "block";
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            closeModal(event.target.id);
        }
    }
</script>
    <!-- Service End -->
   
    

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>