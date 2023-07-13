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

function validateContactForm($data) {
    if (empty($data["errors"])) {
        $data["validForm"] = true;
    }
    return $data;
}

function validateContact() {
    $data = array("values" => array(), "errors" => array(), "validForm" => false);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = cleanContactData($data);
        $data = validateContactFields($data);
        $data = validateContactForm($data);
    }
    return $data;
}