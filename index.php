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
            if ($data["valid"]) {
                $page = "thanks";
            }
            break;
        case "register":
            require "validations.php";
            $data = validateRegister();
            if ($data["valid"]) {
                storeUser($data);
                $page = "login";
            }
            break;
        case "login":
            require "validations.php";
            $data = validateLogin();
            if ($data["valid"]) {
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
    echo   '<header>
                <nav>
                    <ul id="navbar">
                        <li><button type="button"><a class="navlink" href="index.php?page=home">Home</a></button></li>
                        <li><button type="button"><a class="navlink" href="index.php?page=about">About Me</a></button></li>
                        <li><button type="button"><a class="navlink" href="index.php?page=contact">Contact</a></button></li>
                        <li><button type="button"><a class="navlink" href="index.php?page=register">Register</a></button></li>
                    </ul>
                </nav>
            </header>';
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
            showRegisterPage($data);
            break;
        case "login":
            require "login.php";
            showLoginPage();
            break;
    }
}

function showFooter() {
    echo   '<footer>
                <p>Copyright &copy; Quincy 2023</p>
            </footer>';
}

function showBodyEnd() {
    echo    '</body>';
}

function getArrayValue($array, $key, $default='') { 
    return isset($array[$key]) ? $array[$key] : $default; 
}

function showFormError($data, $key) {
    if (empty(getArrayValue($data["errors"], $key))) {
        return '<span class="error">' . getArrayValue($data["errors"], $key) . '</span>';
    }
    else {
        return '<span class="error">* ' . getArrayValue($data["errors"], $key) . '</span>';
    }
}