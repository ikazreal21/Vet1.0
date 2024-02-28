
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Homepage.css">
    <meta http-equiv="refresh" content="100">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <title>Home - VetCare</title>
</head>
<body>
        <!-- Landing Area -->
        <section id="landing__area" class="container__center">
    <?php include("navbar.php"); ?>

            <div class="landing__content center__row">
                <div class="landing__info align__left">
                    <h1>
                        Where Care Meets <br>
                        Compassion for Your Beloved Pets
                    </h1>
                    <p>Veterinary Services, Grooming Services, Pet Supplies.</p>
                    <button><a href="login.php">Book An Appointment</a></button>

                </div>
                <div class="image__pet"></div>
            </div>
        
        </section>

        <!-- HELP  -->
        <section id="help" class="container__center">
            <h1>Things we have for your pets!</h1>
            <div class="help__cards--container center__row">
                <div class="help__card container__center">
                    <span class="card__title">Veterinary Services</span>
                    <h3>A Healthy pet is A Happy pet</h3>
                    <p>"Comprehensive veterinary care for your pet's health and happiness."</p>
                    <div class="card__link container__center">
                        <a href="login.php">Book now</a>
                    </div>
                </div>
                <div class="help__card container__center">
                    <span class="card__title">Grooming Services</span>
                    <h3>Compassionate and caring services</h3>
                    <p>"Elevate your pet's style and comfort with our professional grooming service."</p>
                    <div class="card__link container__center">
                        <a href="login.php">Book Now</a>
                    </div>
                </div>
                <div class="help__card container__center">
                    <span class="card__title">Pet Supplies</span>
                    <h3>Help the Pets Care Foundation</h3>
                    <p>"Discover a world of pet supplies that cater to every need, from nutrition to play."</p>
                    <div class="card__link container__center">
                        <a href="#">See more</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery 
        <section id="gallery">
            <img src="img15.jpg" class="img__gallery" id="img-1">
            <img src="img1.jpg" class="img__gallery" id="img-2">
            <img src="img7.jpg" class="img__gallery" id="img-3">
            <img src="img10.jpg" class="img__gallery" id="img-4">
            <img src="img14.jpg" class="img__gallery" id="img-5">
            <img src="img13.jpg" class="img__gallery" id="img-6">
            <img src="img2.jpg" class="img__gallery" id="img-7">
            <img src="img11.jpg" class="img__gallery" id="img-8">
            <img src="img12.jpg" class="img__gallery" id="img-9">
        </section>-->

        <?php include('footer.php');?>

</body>
</html>