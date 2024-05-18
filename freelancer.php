<?php
// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=ranim', 'root', '');
    // Définir le mode d'erreur PDO à exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // En cas d'erreur de connexion, afficher l'erreur
    die("Erreur : " . $e->getMessage());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs saisies dans le formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Préparer la requête SQL pour insérer les données dans la table 'messages'
    $sql = "INSERT INTO messages (name, email, phone, subject, message) VALUES (:name, :email, :phone, :subject, :message)";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':message', $message);

    // Exécuter la requête
    try {
        $stmt->execute();
        echo "Message envoyé avec succès.";
    } catch (PDOException $e) {
        echo "Erreur lors de l'envoi du message : " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" charset="utf-8">
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
        <img src="image/group.png">
        <h2 class="top-trainer">Choose freelancers </h2>
        <h4 class="quote-trainer">- "Freelancing is not just a job, it's a lifestyle where passion meets freedom, and creativity knows no bounds".</h4>
      </div>
    </main>

  
  
  

  
  <section class="container2">
    <!-- Insérez ici le code HTML existant pour les candidats -->
    <!-- Je vais ajouter un bouton de contact pour chaque candidat -->
    <section class="trainer">
      <div class="container">
        <div class="blog-post">
          <div class="blog-post_img trainimg">
            <img src="image/undraw_Developer_activity_re_39tg.png" alt="">
          </div>
          <div class="blog-post_info">
            <div class="blog-post_date">
              <span>
                <a href="https://www.facebook.com/ATTEducationMM" id="trainer-icon"><i class="fa fa-facebook"></i></a>
                <a href="https://github.com/ATTEducation" id="trainer-icon"><i class="fa fa-github"></i></a>
                <a href="https://www.instagram.com/atteducationmm/" id="trainer-icon"><i class="fa fa-instagram"></i></a>
              </span>
            </div>
            <h1 class="blog-post_title">Aung T Tant</h1>
            <p class="blog-post_text">
              "A cybersecurity enthusiast who has specialized in the ethics of hacking. He is constantly driven by the challenge of understanding security flaws in systems and networks but with the intention to fix them rather than exploit them. He actively seeks to discover new attack methods and hone his skills in protecting against cyber threats."
            </p>
            <button class="btn btn-contact" onclick="showContactForm('aung_t_tant')">Contacter</button>
      <div id="contactForm_aung_t_tant" style="display: none;">
        <div class="col-md-8">
          <h3>Your Message</h3>
          <p>
            For any feedback
          </p>
          <form class="form-light mt-20" role="form" method="post">
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" placeholder="Your name" required>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email address" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control" name="phone" placeholder="Phone number" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Subject</label>
        <input type="text" class="form-control" name="subject" placeholder="Subject" required>
    </div>
    <div class="form-group">
        <label>Message</label>
        <textarea class="form-control" name="message" id="message" placeholder="Write your message here..." style="height:100px;" required></textarea>
    </div>
    <button type="submit" class="btn btn-two">Send message</button>
    <p><br/></p>
</form>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
  




  <section class="container2">
    <!-- Insérez ici le code HTML existant pour les candidats -->
    <!-- Je vais ajouter un bouton de contact pour chaque candidat -->
    <section class="trainer">
      <div class="container">
        <div class="blog-post">
          <div class="blog-post_img trainimg">
            <img src="image/undraw_dev_productivity_umsq.png" alt="">
          </div>
          <div class="blog-post_info">
            <div class="blog-post_date">
              
             <span><a href="https://www.facebook.com/ATTEducationMM"  id="trainer-icon"><i class="fa fa-facebook"></i></a>
               <a href="https://github.com/ATTEducation" id="trainer-icon"><i class="fa fa-github"></i></a>
               <a href="https://www.instagram.com/atteducationmm/" id="trainer-icon"><i class="fa fa-instagram" ></i></a></span>
            </div>
               <h1 class="blog-post_title">Aung Pyae Ko</h1>
               <p class="blog-post_text">
                 "When I worked in medicine, I could not imagine another life. However, once I crossed the threshold of the class, as I understood: this is exactly the place where I should be"
               </p>
           
               <button class="btn btn-contact" onclick="showContactForm('Aung_Pyae_Ko')">Contacter</button>
               <div id="contactForm_Aung_Pyae_Ko" style="display: none;">
                 <div class="col-md-8">
                   <h3>Your Message</h3>
                   <p>
                     For any feedback
                   </p>
                   <form class="form-light mt-20" role="form">
                     <div class="form-group">
                       <label>Name</label>
                       <input type="text" class="form-control" placeholder="Your name">
                     </div>
                     <div class="row">
                       <div class="col-md-6">
                         <div class="form-group">
                           <label>Email</label>
                           <input type="email" class="form-control" placeholder="Email address">
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                           <label>Phone</label>
                           <input type="text" class="form-control" placeholder="Phone number">
                         </div>
                       </div>
                     </div>
                     <div class="form-group">
                       <label>Subject</label>
                       <input type="text" class="form-control" placeholder="Subject">
                     </div>
                     <div class="form-group">
                       <label>Message</label>
                       <textarea class="form-control" id="message" placeholder="Write you message here..." style="height:100px;"></textarea>
                     </div>
                     <button type="submit" class="btn btn-two">Send message</button><p><br/></p>
                   </form>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </section>

    <section class="container2">
      <!-- Insérez ici le code HTML existant pour les candidats -->
      <!-- Je vais ajouter un bouton de contact pour chaque candidat -->
      <section class="trainer">
        <div class="container">
          <div class="blog-post">
            <div class="blog-post_img trainimg">
              <img src="image/undraw_podcast_q6p7.png" alt="">
            </div>
            <div class="blog-post_info">
              <div class="blog-post_date">
                
               <span><a href="https://www.facebook.com/ATTEducationMM"  id="trainer-icon"><i class="fa fa-facebook"></i></a>
                 <a href="https://github.com/ATTEducation" id="trainer-icon"><i class="fa fa-github"></i></a>
                 <a href="https://www.instagram.com/atteducationmm/" id="trainer-icon"><i class="fa fa-instagram" ></i></a></span>
              </div>
              <h1 class="blog-post_title">Niang Suan Kim</h1>
              <p class="blog-post_text">
                "My academic background has equipped me with a strong understanding of telecommunications technologies and network infrastructure, as well as the ability to analyze and troubleshoot network issues. I am also fascinated by the world of Cyber Security and Pen- testing which's been the topic of my end of studies' project.
                Today I'm pursuing an engineering degree at TEK-UP University specializing in Cybersecurity."
              </p>
          
              <button class="btn btn-contact" onclick="showContactForm('Niang_Suan_Kim')">Contacter</button>
              <div id="contactForm_Niang_Suan_Kim" style="display: none;">
                <div class="col-md-8">
                  <h3>Your Message</h3>
                  <p>
                    For any feedback
                  </p>
                  <form class="form-light mt-20" role="form">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" placeholder="Your name">
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" class="form-control" placeholder="Email address">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Phone</label>
                          <input type="text" class="form-control" placeholder="Phone number">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Subject</label>
                      <input type="text" class="form-control" placeholder="Subject">
                    </div>
                    <div class="form-group">
                      <label>Message</label>
                      <textarea class="form-control" id="message" placeholder="Write you message here..." style="height:100px;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-two">Send message</button><p><br/></p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="container2">
        <!-- Insérez ici le code HTML existant pour les candidats -->
        <!-- Je vais ajouter un bouton de contact pour chaque candidat -->
        <section class="trainer">
          <div class="container">
            <div class="blog-post">
              <div class="blog-post_img trainimg">
                <img src="image/undraw_uploading_go67.png" alt="">
              </div>
              <div class="blog-post_info">
                <div class="blog-post_date">
                  
                 <span><a href="https://www.facebook.com/ATTEducationMM"  id="trainer-icon"><i class="fa fa-facebook"></i></a>
                   <a href="https://github.com/ATTEducation" id="trainer-icon"><i class="fa fa-github"></i></a>
                   <a href="https://www.instagram.com/atteducationmm/" id="trainer-icon"><i class="fa fa-instagram" ></i></a></span>
                </div>
                <h1 class="blog-post_title">Aung Phyo Hein</h1>
                <p class="blog-post_text">
                  "The teacher is one of the most difficult professions, which brings both moral feelings and a huge reward!"
                </p>
              
              
                
                <button class="btn btn-contact" onclick="showContactForm('Aung_Phyo_Hein')">Contacter</button>
      <div id="contactForm_Aung_Phyo_Hein" style="display: none;">
        <div class="col-md-8">
          <h3>Your Message</h3>
          <p>
            For any feedback
          </p>
          <form class="form-light mt-20" role="form">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" placeholder="Your name">
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" placeholder="Email address">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Phone</label>
                  <input type="text" class="form-control" placeholder="Phone number">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Subject</label>
              <input type="text" class="form-control" placeholder="Subject">
            </div>
            <div class="form-group">
              <label>Message</label>
              <textarea class="form-control" id="message" placeholder="Write you message here..." style="height:100px;"></textarea>
            </div>
            <button type="submit" class="btn btn-two">Send message</button><p><br/></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<script>
  function showContactForm(trainerName) {
    var contactForm = document.getElementById("contactForm_" + trainerName);
    if (contactForm.style.display === "none") {
      contactForm.style.display = "block";
    } else {
      contactForm.style.display = "none";
    }
  }
  
</script>
  





<br>
</section>
    
</body>

    <footer class="footer-distributed">
            <div class="footer-left">
              <a href="index.html"><img src="image/freelance.png" style="margin-left: 2rem; width: 150px; height: auto;"></a>
    
                <p class="footer-links">
                    <a href="index.html">HOME</a>
                    |
                    <a href="categories.php">CATEGORIES</a>
                    |
                    <a href="freelancer.php">FREELANCER</a>
                    |
                    <a href="about.html">ABOUT</a>
                    |
                    <a href="contact.php">CONTACT</a>
                    |
                    <a href="signup.php">SIGN UP</a>
                    |
                    <a href="login.php">LOGIN</a>
                </p>
    
                <p class="footer-company-name">Copyright © 2024 <strong>ToTheTopFREELANCER</strong> All rights reserved</p>
            </div>
    
            <div class="footer-center">
                <div class="center-link">
                    <a href="#"><i class="fa fa-map-marker"></i></a>
                    <p><span>Tunis</span>
                        Tunisie</p>
                </div>
    
                <div class="center-link">
                    <a href="tel:+95975125012"><i class="fa fa-phone"></i></a>
                    <p>(+216) 9751252012 </p>
                </div>
                <div class="center-link">
                    <a href="mailto:tothetopfreelancer@gmail.com"><i class="fa fa-envelope"></i></a>
                    <p><a href="mailto:tothetopfreelancer@gmail.com">tothetopfreelancer@gmail.com</a></p>
                </div>
            </div>
            <div class="footer-right">
                <p class="footer-company-about">
                    <span>About the company</span>
                    <strong>To The Top FREELANCER</strong>we are committed to providing top-notch customer service, striving for excellence in every aspect of our work. We are dedicated to exceeding expectations, continuously seeking innovation, and executing the most demanding projects with diligence and professionalism!
                </p>
                <div class="footer-icons">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-github"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                   
                </div>
            </div>
        </footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</html>