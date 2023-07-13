<?php
$page = getRequestedPage();
$data = processRequest($page);
showResponsePage($data);

function getRequestedPage() {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $page = $_GET["page"];
    }
    elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        $page = $_POST["page"];
    }
    return $page;
}

function processRequest($page) {
    switch($page) {
        case "contact":
            require "validations.php";
            $data = validateContact();
            var_dump($data);
            if ($data["validForm"]) {
                $page = "thanks";
            }
            break;
        case "register":
            $data = validateRegister();
            if ($data["validRegistration"]) {
                storeUser();
                $page = "login";
            }
            break;
        case "login":
            $data = validateLogin();
            if ($data["validLogin"]) {
                loginUser();
                $page = "home";
            }
            break;
        case "logout":
            logoutUser();
            $page = "home";
            break;
        }
    $data["page"] = $page;
    return $data;

}

function showResponsePage($data) {
    showDocumentStart();
    showHeadSection($data);
    showBodySection($data);
    showDocumentEnd();
}   

function showDocumentStart() {
    echo '<!DOCTYPE html>
          <html>';
}

function showHeadSection($data) {
    echo '<head>
            <title>' . ucfirst($data["page"]) . '</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
            <link rel="stylesheet" href="CSS/stylesheet.css">
         </head>';
}

function showBodySection($data) {
    showBodyStart();
    showMenu();
    showContent($data);
    showFooter();
    showBodyEnd();
}

function showDocumentEnd() {
    echo '</html>';
}

function showBodyStart() {
    echo '<body>';
}

function showMenu() {
    echo    '<header id="header">
                <div class="navbar_container">
                    <ul id="navbar">
                        <li><a class="navlink" href="index.php?page=home">Home</a></li>
                        <li><a class="navlink" href="index.php?page=about">About Me</a></li>
                        <li><a class="navlink" href="index.php?page=contact">Contact</a></li>
                    </ul>
                </div>
            </header><br>';
}

function showPageNotFound() {
    ###
}

function showContent($data) {
    switch ($data["page"]) {
       case "home":
            require "home.php";
            showHomeContent();
            break;
        case "about":
            require "about.php";
            showAboutContent();
            break;
        case "contact":
            require "contact.php";
            showContactForm($data);
            break;
        case "thanks":
            require "contact.php";
            showContactThanks($data);
            break;
        case "register":
            require "register.php";
            showRegisterPage();
            break;
        case "login":
            require "login.php";
            showLoginPage();
            break;
    }
}

function showFooter() {
    echo    '<div class="foot_container">
                <footer id="footer" class="footer">
                    <p id="footer_text">Copyright &copy; Quincy 2023</p>
                </footer>
            </div>';
}

function showBodyEnd() {
    echo    '</body>';
}