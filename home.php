<?php  

function showHomeContent() {
    echo   '<h1>Home</h1>
            <div class="row">
                <div class="column">
                    <p id="welcome" class="home">Hi! I\'m Quincy.<br>Welcome to my website.</p>
                </div>
                <div class="column">
                    <img class="home" src="img/profile_picture.JPG" alt="A profile picture of me">
                </div>
            </div>
            <button type="button" class="get_in_touch"><a href="index.php?page=contact">Get in Touch</a></button>';
}
