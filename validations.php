<?php

function cleanContactData($data) {
    foreach ($_POST as $key => $value) {
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        $data["values"][$key] = $value;
    }
    return $data;
}

function validateContactFields($data) {
    foreach ($data["values"] as $key => $value) {
        if (empty($value)) {
            $data["errors"][$key] = ucfirst(str_replace("_", " ", $key)) .  " is required";
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

function validateContactForm($data) {
    if (empty($data["errors"])) {
        $data["validForm"] = true;
    }
    return $data;
}

function validateContact() {
    $contact_fields = array("gender"=>"","name"=>"","email"=>"","phone"=>"","subject"=>"","communication_preference"=>"","message"=>"");
    $data = array("values" => $contact_fields, "errors" => array(), "validForm" => false);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = cleanContactData($data);
        $data = validateContactFields($data);
        $data = validateContactForm($data);
    }
    return $data;
}

function validateRegister() {
    $register_fields = array("email"=>"","name"=>"","password"=>"");
    $data = array("values"=>$register_fields,"validRegistration"=>false);

}