<?php 

function createNewContact() {
    $data = array("values" => array(), "errors" => array(), "validForm" => false);
    $data["values"]["gender"] = "";
    $data["values"]["name"] = "";
    $data["values"]["email"] = "";
    $data["values"]["phone"] = "";
    $data["values"]["subject"] = "";
    $data["values"]["comm_pref"] = "";
    $data["values"]["message"] = "";
    return $data;
}

function validateContact($data) {
    $data = cleanData($data);
    $data = validateData($data);
    $data = validateForm($data);
    return $data;
}

function cleanData($data) {
    foreach ($_POST as $key => $value) {
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        $data["values"][$key] = $value;
    }
    return $data;
}
###
function validateData($data) {
    foreach ($data["values"] as $key => $value) {
        if (empty($value)) {
            if ($key == "comm_pref") {
                $data["errors"][$key] = "Communication preference is required";
            }
            else {
                $data["errors"][$key] = ucfirst($key) .  " is required";
            }
        }
        else {
            switch($key) {
                case "name":
                    if (!preg_match("/^[a-zA-Z-' ]*$/",$data["values"]["name"])) {
                        $data["errors"]["name"] = "Only letters and white space allowed";
                    }
                case "email":
                    if (!filter_var($data["values"]["email"], FILTER_VALIDATE_EMAIL)) {
                        $data["errors"]["email"] = "Invalid email format";
                    }
            } 
        }
    }
    return $data;
}

function validateForm($data) {
    if (empty($data["errors"])) {
        $data["validForm"] = true;
    }
    return $data;
}

function showContactThanks($data) {
    echo   'Thank you for reaching out.<br><br>
            Gender: ' . getArrayValue($data["values"], "gender") . '<br>
            Name: ' . getArrayValue($data["values"], "name") . '<br>
            Email: ' . getArrayValue($data["values"], "email") . '<br>
            Phone: ' . getArrayValue($data["values"], "phone") . '<br>
            Subject: ' . getArrayValue($data["values"], "subject") . '<br>
            Communication preference: ' . getArrayValue($data["values"], "comm_pref") . '<br>
            Message: ' . getArrayValue($data["values"], "message") . '<br>';   
}

function getArrayValue($array, $key, $default='') { 
    return isset($array[$key]) ? $array[$key] : $default; 
}
###
function showContactContent() {
    $data = createNewContact();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = validateContact($data);
        if ($data["validForm"]) {
            showContactThanks($data);
        }
        else {
            showContactForm($data);
        }
    }
    else {
        showContactForm($data);
    }
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
    echo    '<form action="index.php" method="POST">
<!- Dropdown menu ->
                <div class="form_group">    
                    <label class="form_label" for="gender">Gender</label> 
                    <select id="gender" name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    ' . showFormError($data, "gender") . '
                </div>
<!- Inputfields ->
                <div>
                    <div class="form_group">
                        <label class="form_label" for="name">Name</label>
                        <input class="form_response" type="text" id="name" name="name" value="' . getArrayValue($data["values"], "name") . '">
                        ' . showFormError($data, "name") . '
                    </div>
                    <div  class="form_group">
                        <label class="form_label" for="email">Email</label>
                        <input class="form_response" type="text" id="email" name="email" value="' . getArrayValue($data["values"], "email") . '">
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
                </div>
<!- Radio buttons ->
                <div class="form_group">
                    <label id="comm_pref" class="form_label" for="comm_pref">Communication preference</label>
                    ' . showFormError($data, "comm_pref") . '
                    <div class="form_group">
                        <input type="radio" value="Email" id="email" name="comm_pref">
                        <label class="form_label" for="email">Email</label>
                    </div>
                    <div class="form_group">
                        <input type="radio" value="Phone" id="phone" name="comm_pref">
                        <label class="form_label" for="phone">Phone</label>
                    </div>
                </div>
<!- Textarea ->
                <div class="form_group">
                    <label class="form_label" for="message">Message</label>
                    <div class="form_group">
                        <textarea class="form_response" name="message" id="form_response_msg" cols="30" rows="10" value="' . getArrayValue($data["values"], "message") . '"></textarea>
                        ' . showFormError($data, "message") . '
                    </div>
                </div>
<!- Submit button ->
                <input class="form_submit_btn" type="submit" value="Submit">
            </form>';
}