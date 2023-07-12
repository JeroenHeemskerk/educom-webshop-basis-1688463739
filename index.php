<?php
$page = getRequestedPage();
showResponsePage($page);

function getRequestedPage() {
    return $_GET['page'];
}

function showResponsePage($page) {
    showDocumentStart();
    showHeadSection($page);
    showBodySection($page);
    showDocumentEnd();
}   

function showDocumentStart() {
    echo '<!DOCTYPE html>
          <html>';
}

function showHeadSection($page) {
    echo '<head>
            <title>' . $page . '</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
            <link rel="stylesheet" href="CSS/stylesheet.css">
         </head>';
}

function showBodySection($page) {
    showBodyStart();
    showMenu();
    showContent($page);
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

function showContent($page) {
    switch ($page) {
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
            showContactContent();
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