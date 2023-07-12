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

function validateContact() {
    $data = cleanData($data);
    $data = validateData($data);
    $data = validateForm($data);
    return $data;
}

### $_POST
function cleanData($data) {
    foreach ($_POST as $key => $value) {
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        $data["values"]["key"] = $value;
    }
    return $data;
}

function validateData($data) {
    $data = validateFields($data);
    $data = validateName($data);
    $data = validateEmail($data);
}
###
function validateField($data) {
    foreach ($data["values"] as $key => $value) {
        $value = cleanData($value);
    }
}
function validateFields($data) {
    foreach ($data["values"] as $key => $value) {
        if (empty($value)) {
            $data = recordError($data, $key, "emptyField");
        }
    }
    return $data;
}

function validateName($data) {
    if (!preg_match("/^[a-zA-Z-' ]*$/",$data["values"]["name"])) {
        $data = recordError($data, "name", "invalidName");
    }
    return $data;
}

function validateEmail($data) {
    if (!filter_var($data["values"]["email"], FILTER_VALIDATE_EMAIL)) {
        $data = recordError($data, "email", "invalidEmail");
    }
    return $data;
}

function recordError($data, $key, $error) {
    switch ($error) {
        case "emptyField":
            if ($key == "comm_pref") {
                $data["errors"][$key] = "Communication preference is required";
            }
            else {
                $data["errors"][$key] = $key .  "is required";
            }
        case "invalidName":
            $data["errors"][$key] = "Only letters and white space allowed";
        case "invalidEmail":
            $data["errors"][$key] = "Invalid email format";
    }
    return $data;
}

function validateForm($data) {
    if (empty($data["errors"])) {
        $data["validForm"] = true;
    }
    return $data;
}

function showThankYou($data) {
    echo   'Thank you for reaching out.<br>
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
            showThankYou($data);
        }
        else {
            showContactForm($data);
        }
    }
    else {
        showContactForm($data);
    }
}

function showContactError($data, $key) {
    echo '<span class="error">* ' . getArrayValue($data["errors"], $key) . '</span>';
}

function showContactForm($data) {
    echo    '<form action="contact.php" method="POST">
<!- Dropdown menu ->
                <div class="form_group">    
                    <label class="form_label" for="gender">Gender</label> 
                    <select id="gender" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
<!- Inputfields ->
                <div>
                    <div class="form_group">
                        <label class="form_label" for="name">Name</label>
                        <input class="form_response" type="text" id="name" name="name" value="' . getArrayValue($data["values"], "name") . '">
                        ' . showContactError($data, "name") . '
                    </div>
                    <div  class="form_group">
                        <label class="form_label" for="email">Email</label>
                        <input class="form_response" type="text" id="email" name="email" value="' . getArrayValue($data["values"], "email") . '">
                        ' . showContactError($data, "email") . '
                    </div>
                    <div class="form_group">
                        <label class="form_label" for="phone">Phone</label>
                        <input class="form_response" type="text" id="phone" name="phone" value="' . getArrayValue($data["values"], "phone") . '">
                        ' . showContactError($data, "phone") . '
                    </div>
                    <div class="form_group">
                        <label class="form_label" for="subject">Subject</label>
                        <input class="form_response" type="text" id="subject" name="subject" value="' . getArrayValue($data["values"], "subject") . '">
                        ' . showContactError($data, "subject") . '
                    </div>
                </div>
<!- Communication preference ->
                <div class="form_group">
                    <label id="comm_pref" class="form_label" for="comm_pref">Communication preference:</label>
                    ' . showContactError($data, "comm_pref") . '
                    <div class="form_group">
                        <input type="radio" value="email" id="email" name="comm_pref">
                        <label class="form_label" for="email">Email</label>
                    </div>
                    <div class="form_group">
                        <input type="radio" value="phone" id="phone" name="comm_pref">
                        <label class="form_label" for="phone">Phone</label>
                    </div>
                </div>
<!- Message ->
                <div class="form_group">
                    <label class="form_label" for="message">Message</label>
                    <div class="form_group">
                        <textarea class="form_response" name="message" id="form_response_msg" cols="30" rows="10" value="' . getArrayValue($data["values"], "message") . '"></textarea>
                        ' . showContactError($data, "message") . '
                    </div>
                </div>
<!- Submit button ->
                <input class="form_submit_btn" type="submit" value="Submit">
            </form>';
}