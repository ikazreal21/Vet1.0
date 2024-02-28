<style>
.logo {
    display: inline-block;
    vertical-align: middle;
}

.round-logo {
    max-width: 120px; /* Adjust the size of the logo as needed */
    vertical-align: middle;
    border-radius: 30%; /* Creates a round shape */
}

.logo-title {
    display: inline-block;
    margin-left: 5px; /* Adjust the spacing between the logo and title */
    font-size: 36px; /* Adjust the font size as needed */
    margin-top: 40px;
}

.center__row {
    padding-top: 0px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.align__left {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
}

h1 {
    font-weight: 300;
    font-size: 40px;
    letter-spacing: 2px;
    color: #2F4858;
}

p {
    font-size: 18px;
    letter-spacing: 2px;
    line-height: 22px;
    margin: 2rem 0;
    color: #2F4858;
}

a {
    text-decoration: none;
}

ul li {
    list-style: none;
}

#landing__area nav {
    height: 5%;
    width: 80%;
}

nav .logo {
    color: #3FDAA0;
}

nav a {
    color: #86BBD8;
    margin: 0 20px;
}

nav a:hover {
    color: #F6AE2D;
}
</style><nav class="center__row">
        <div class="logo">
        <img class="round-logo" src="logo1.png" alt="Logo">
            <h1 class="logo-title"><a href="homepage.php">VetCare</h1>
        </div>
        <ul class="center__row">
            <li><a href="services.php">Services</a></li>
            <!--<li><a href="facilities.php">Facilities</a></li>-->
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Contacts</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>