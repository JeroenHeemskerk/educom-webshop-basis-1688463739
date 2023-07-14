<?php 

function getArrayValue($array, $key, $default='') { 
    return isset($array[$key]) ? $array[$key] : $default; 
}

function showContactThanks($data) {
    echo   '<div class="content">
                Thank you for reaching out.<br><br>
                Gender: ' . getArrayValue($data["values"], "gender") . '<br>
                Name: ' . getArrayValue($data["values"], "name") . '<br>
                Email: ' . getArrayValue($data["values"], "email") . '<br>
                Phone: ' . getArrayValue($data["values"], "phone") . '<br>
                Subject: ' . getArrayValue($data["values"], "subject") . '<br>
                Communication preference: ' . getArrayValue($data["values"], "communication_preference") . '<br>
                Message: ' . getArrayValue($data["values"], "message") . '<br>
            </div>';  
}

function showFormError($data, $key) {
    if (empty(getArrayValue($data["errors"], $key))) {
        return '<span class="error">' . getArrayValue($data["errors"], $key) . '</span>';
    }
    else {
        return '<span class="error">* ' . getArrayValue($data["errors"], $key) . '</span>';
    }
}

function showContactForm($data) {
    echo   '<div class="content">
                <h1>Contact Me</h1>
                <form action="index.php" method="POST">
                    <input type="hidden" id="page" name="page" value="contact">

        <!- DROPDOWN ->
                    <div class="form_group">    
                        <label class="form_label" for="gender">Gender</label> 
                        <select id="gender" name="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        ' . showFormError($data, "gender") . '
                    </div>
                    
         <!- INPUTFIELDS ->
                        <div class="form_group">
                            <label class="form_label" for="name">Name</label>
                            <input class="form_response" type="text" id="name" name="name" value="' . getArrayValue($data["values"], "name") . '">
                            ' . showFormError($data, "name") . '
                        </div>
                        <div  class="form_group">
                            <label class="form_label" for="email">Email</label>
                            <input class="form_response" type="email" id="email" name="email" value="' . getArrayValue($data["values"], "email") . '">
                            ' . showFormError($data, "email") . '
                        </div>
                        <div class="form_group">
                            <label class="form_label" for="phone">Phone</label>
                            <input class="form_response" type="text" id="phone" name="phone" value="' . getArrayValue($data["values"], "phone") . '">
                            ' . showFormError($data, "phone") . '
                        </div>
                        <div class="form_group">
                            <label class="form_label" for="subject">Subject</label>
                            <input class="form_response" type="text" id="subject" name="subject" value="' . getArrayValue($data["values"], "subject") . '">
                            ' . showFormError($data, "subject") . '
                        </div>

        <!- RADIO BUTTONS ->
                    <div class="form_group">
                        <label id="communication preference" class="form_label" for="communication_preference">Communication preference</label>
                        ' . showFormError($data, "communication_preference") . '
                        <div class="form_group"> 
                            <input type="radio" value="Email" id="email" name="communication_preference">
                            <label class="form_label" for="email">Email</label>
                            <input type="radio" value="Phone" id="phone" name="communication_preference">
                            <label class="form_label" for="phone">Phone</label>
                        </div>
                    </div>

         <!- TEXTAREA ->
                    <div class="form_group">
                        <label class="form_label" for="message">Message</label>
                        <div class="form_group">
                            <textarea class="form_response" name="message" cols="30" rows="10" value="' . getArrayValue($data["values"], "message") . '"></textarea>
                            ' . showFormError($data, "message") . '
                        </div>
                    </div>

        <!- SUBMIT ->
                    <input class="submit" type="submit" value="SUBMIT">
                </form>
            </div>';
}