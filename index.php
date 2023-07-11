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

function showFooter() {
    echo    '<div class="foot_container">
                <footer id="footer" class="footer">
                    <p id="footer_text">Copyright &copy; 2023 by Quincy Tromp</p>
                </footer>
            </div>';
}

function showBodyEnd() {
    echo    '</body>';
}

function showContactContent() {
    echo    '<form action="contact.php" method="POST">
                <!-----------------------------------------------------------------------------
                Dropdown menu section. ------------------------------------------------------->
                                <div class="form_group">    
                                    <label class="form_label" for="gender">Gender</label> 
                                    <select id="gender" name="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                <!-----------------------------------------------------------------------------
                Inputfields section. --------------------------------------------------------->
                                <div>
                                    <div class="form_group">
                                        <label class="form_label" for="name">Name</label>
                                        <input class="form_response" type="text" id="name" name="name" value="<?php echo getArrayVal($form_data, "name"); ?>">
                                        <span class="error">* <?php echo getArrayVal($errors, "name") ?></span>
                                    </div>
                                    <div  class="form_group">
                                        <label class="form_label" for="email">Email</label>
                                        <input class="form_response" type="text" id="email" name="email" value="<?php echo getArrayVal($form_data, "email"); ?>">
                                        <span class="error">* <?php echo getArrayVal($errors, "email") ?></span>
                                    </div>
                                    <div class="form_group">
                                        <label class="form_label" for="phone">Phone</label>
                                        <input class="form_response" type="text" id="phone" name="phone" value="<?php echo getArrayVal($form_data, "phone"); ?>">
                                        <span class="error">* <?php echo getArrayVal($errors, "email") ?></span>
                                    </div>
                                    <div class="form_group">
                                        <label class="form_label" for="subject">Subject</label>
                                        <input class="form_response" type="text" id="subject" name="subject" value="<?php echo getArrayVal($form_data, "subject"); ?>">
                                        <span class="error">* <?php echo getArrayVal($errors, "subject") ?></span>
                                    </div>
                                </div>
                <!----------------------------------------------------------------------------- 
                Communication preference section. -------------------------------------------->
                                <div class="form_group">
                                    <label id="comm_pref" class="form_label" for="comm_pref">Communication preference:</label>
                                    <span class="error">* <?php echo getArrayVal($errors, "comm_pref") ?></span>
                                    <div class="form_group">
                                        <input type="radio" value="email" id="email" name="comm_pref">
                                        <label class="form_label" for="email">Email</label>
                                    </div>
                                    <div class="form_group">
                                        <input type="radio" value="phone" id="phone" name="comm_pref">
                                        <label class="form_label" for="phone">Phone</label>
                                    </div>
                                </div>
                <!-----------------------------------------------------------------------------
                Message section. ------------------------------------------------------------->
                                <div class="form_group">
                                    <label class="form_label" for="message">Message</label>
                                    <div class="form_group">
                                        <textarea class="form_response" name="message" id="form_response_msg" cols="30" rows="10" value="<?php echo getArrayVal($form_data, "message"); ?>"></textarea>
                                        <span class="error">* <?php echo getArrayVal($errors, "message") ?></span>
                                    </div>
                                </div>
                <!----------------------------------------------------------------------------- 
                Submit button. --------------------------------------------------------------->
                                <input class="form_submit_btn" type="submit" value="Submit">
                            </form>';
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

function getRequestedPage() {
    return $_GET['page'];
}

function showResponsePage($page) {
    showDocumentStart();
    showHeadSection($page);
    showBodySection($page);
    showDocumentEnd();
}   
