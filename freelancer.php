<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=client', 'root', '');
if ($_SESSION['user_type'] === 'freelancer') {
    $query = $bdd->prepare("SELECT * FROM freelancer");
    $query->execute();
    $freelancers = $query->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="icon" href="image/logo.png" type="image/x-icon">
        <script src="/javascript/javascript.js"></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
        <title>FREELANCER</title>
    </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
     <div class="imageBox">
        <div class="imageInn">
            <a href="index.html">
                <img src="image/freelance.png" style="margin-left: 1rem; width: 100px; height: auto;" class="logo">
            </a>
        </div>
     </div>
    <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#nav" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon bg-light"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="nav">
        <ul class="navbar-nav">
            <li class="item"><a class="link" href="index.html">HOME</a></li>
            <li class="item"><a class="link" href="categories/index.php">CATEGORIES</a></li>
            <li class="item current"><a class="link" href="freelancer.php">FREELANCER</a></li>
            <li class="item"><a class="link" href="about.html">ABOUT</a></li>
            <li class="item"><a class="link" href="contact.php">CONTACT</a></li>
            <li class="item"><a class="link" href="signup.php">SIGN UP</a></li>
            <li class="item"><a class="link" href="login.php">LOGIN</a></li>
        </ul>
    </div>
</nav>
<main>
    <div class="container">       
        <h2 class="top-trainer">Choose freelancers </h2>
        <h4 class="quote-trainer">- "Freelancing is not just a job, it's a lifestyle where passion meets freedom, and creativity knows no bounds".</h4>
    </div>
</main>
<section class="container2">
    <!-- Insérez ici le code HTML existant pour les candidats -->
    <!-- Je vais ajouter un bouton de contact pour chaque candidat -->
    <?php foreach ($freelancers as $freelancer): ?>
    <section class="trainer">
        <div class="container">
            <div class="blog-post">
                <div class="blog-post_img trainimg">
                    <img src="uploads/<?php echo $freelancer['image']; ?>" alt="Profile Image">
                </div>
                <div class="blog-post_info">
                    <div class="blog-post_date">
                    <span><a href="https://www.facebook.com/ATTEducationMM"  id="trainer-icon"><i class="fa fa-facebook"></i></a>
                   <a href="https://github.com/ATTEducation" id="trainer-icon"><i class="fa fa-github"></i></a>
                   <a href="https://www.instagram.com/atteducationmm/" id="trainer-icon"><i class="fa fa-instagram" ></i></a></span>
                    </div>
                    <h1 class="blog-post_title"><?php echo $freelancer['skills']; ?></h1>
                    <p class="blog-post_text"><?php echo $freelancer['email']; ?></p>
                    <button class="btn btn-contact" onclick="showContactForm('<?php echo $freelancer['skills']; ?>')">Contact Me Via Mail</button>
                    <div id="contactForm_<?php echo $freelancer['skills']; ?>" style="display: none;">
                        <div class="col-md-8">
                            <h3>Your Message</h3>
                            <p>For any feedback</p>
                            <form class="form-light mt-20" role="form" method="post">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Your name" required>
                                </div>
                                <!-- Ajoutez ici les autres champs du formulaire -->
                                <button type="submit" class="btn btn-two">Send message</button>
                                <p><br/></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endforeach; ?>
</section>

<footer class="footer-distributed">
    <!-- Votre pied de page ici -->
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>
