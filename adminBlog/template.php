<?php
    $blogFileRead = json_decode(file_get_contents("data.json"), true);
    $name = $blogFileRead['name'];
    $tags = $blogFileRead['tags'];
    $discription = $blogFileRead['discription'];
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo $name; ?></title>
    <meta content="<?php echo $tags; ?>" name="description">
    <meta content="<?php echo $tags; ?>" name="keywords">

    <!-- Favicons -->
    <link href="../../assets/img/favicon.png" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Moderna - v4.1.0
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
        <!-- Data from header.html -->
    </header>
    <!-- End Header -->

    <main id="main">

        <!-- ======= Blog Section ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h1> </h1>

                    <ol>
                        <li><a href="../../index.html">Home</a></li>
                        <li><a href="../../blog.html">Blog</a></li>
                        <li><?php echo $name; ?></li>
                    </ol>
                </div>

            </div>
        </section>
        <!-- End Blog Section -->

        <!-- ======= Blog Single Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row">

                    <div class="col-lg-8 entries">

                        <article class="entry entry-single">

                            <div class="entry-img">
                                <img src="./blogImage.jpg" alt="<?php echo $name; ?>" class="img-fluid">
                            </div>

                            <h1 class="entry-title">
                                <a href="#"><?php echo $name; ?></a>
                            </h1>



                            <div class="entry-content">
                                <p>
                                    <?php echo $discription; ?>
                                </p>

                            </div>


                        </article>
                        <!-- End blog entry -->

                    </div>
                    <!-- End blog entries list -->

                    <div class="col-lg-4">

                        <div class="sidebar">


                            <h3 class="sidebar-title">Recent Posts</h3>
                            <div class="sidebar-item recent-posts" id="recentListAtHere">


                            </div>
                            <!-- End sidebar recent posts-->

                        </div>
                        <!-- End sidebar -->

                    </div>
                    <!-- End blog sidebar -->

                </div>

            </div>
        </section>
        <!-- End Blog Single Section -->

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">


    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../../assets/vendor/aos/aos.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../../assets/vendor/php-email-form/validate.js"></script>
    <script src="../../assets/vendor/purecounter/purecounter.js"></script>
    <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../../assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Template Main JS File -->
    <script src="../../assets/js/main.js"></script>
    <script>
        $('#header').load('../../header.html');
        $('#footer').load('../../footer.html');
        $.getScript('../../assets/js/main.js');

        const apiCallUrl = '/adminBlog/';
        $("#recentListAtHere").load(apiCallUrl + "recent.php");
    </script>

</body>

</html>