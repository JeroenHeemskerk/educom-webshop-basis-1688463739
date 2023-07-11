<?php
$page = getRequestedPage();
showResponsePage($page);


function showDocumentStart() {
    echo '<!DOCTYPE html>
          <html>';
}

function showDocumentEnd() {
    echo '</html>';
}

function showHeadSection($title) {
    echo '<head>
            <title>' . $title . '</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
            <link rel="stylesheet" href="CSS/stylesheet.css">
         </head>';
}

function showBodySection() {
    showBodyStart()
    showMenu()
    #showContent()
    showFooter()
    showBodyEnd()
}

function showBodyStart() {
    echo '<body>';
}

function showMenu() {
    echo '<header id="header">
            <div class="navbar_container">
                <ul id="navbar">
                    <li><a class="navlink" href="index.php?page=home">Home</a></li>
                    <li><a class="navlink" href="index.php?page=about">About Me</a></li>
                    <li><a class="navlink" href="index.php?page=contact">Contact</a></li>
                </ul>
            </div>
         </header><br>';
}

function showFooter() {
    echo '<div class="foot_container">
            <footer id="footer" class="footer">
                <p id="footer_text">Copyright &copy; 2023 by Quincy Tromp</p>
            </footer>
         </div>';
}

function showBodyEnd() {
    echo '</body>';
}

function showContent() {
    #
}

function getRequestedPage() {
    #
}