<?php 
    /*************************************************************************
    *                         Initiate Variables & Functions                 *
    **************************************************************************/
    $form_data = array("gender"=>"","name"=>"","email"=>"","phone"=>"","subject"=>"","comm_pref"=>"","message"=>"");
    $errors = array("gender"=>"","name"=>"","email"=>"","phone"=>"","subject"=>"","comm_pref"=>"","message"=>"");
   
    function validate($array, $array2) {
        cleanData1($array)
    }

    function cleanData1($array) {
        foreach ($_POST as $key => $value) {
            $value = trim($value);
            $value = stripslashes($value);
            $value = htmlspecialchars($value);
            $array[$key] = $value;
            return $array;
        }
    }

    function validate

    function cleanData($value) {
        # Returns clean value
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        return $value;
    }

    function validateData($key, $value) {
        # Returns error message if data is unvalid
        switch ($key) {
            case "comm_pref":
                if (empty($value)) {
                    return "Communication preference is required"; 
                }
        }
        if (empty($value)) {
            return "$key is required";
        }
        switch ($key) {
            case "name":
                if (!preg_match("/^[a-zA-Z-' ]*$/",$value)) {
                    return "Only letters and white space allowed";
                }
                break;
            case "email":
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    return "Invalid email format";
                }
        }
    }

    function isEmpty($my_array) {
        return in_array("", $my_array);
    }

    function getArrayVal($array, $key, $default='') { 
        return isset($array[$key]) ? $array[$key] : $default; 
    }

    function thankYou($form_data) {
        echo    'Thank you for reaching out. <br>
                Gender: ' . $form_data['gender'] . '<br>
                Name: ' . $form_data['name'] . ' <br>
                Email: ' . $form_data['email'] . ' <br>
                Phone: ' . $form_data['phone'] . ' <br>
                Subject: ' . $form_data['subject'] . ' <br>
                Communication preference: ' . $form_data['comm_pref'] . ' <br>
                Message: ' . $form_data['message'] . ' <br>';   
    }

    function showContactContent($form_data, $errors) {
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
                                            <input class="form_response" type="text" id="name" name="name" value="' . getArrayVal($form_data, "name") . '">
                                            <span class="error">* ' . getArrayVal($errors, "name") . '</span>
                                        </div>
                                        <div  class="form_group">
                                            <label class="form_label" for="email">Email</label>
                                            <input class="form_response" type="text" id="email" name="email" value="' . getArrayVal($form_data, "email") . '">
                                            <span class="error">* ' . getArrayVal($errors, "email") . '</span>
                                        </div>
                                        <div class="form_group">
                                            <label class="form_label" for="phone">Phone</label>
                                            <input class="form_response" type="text" id="phone" name="phone" value="' . getArrayVal($form_data, "phone") . '">
                                            <span class="error">* ' . getArrayVal($errors, "email") . '</span>
                                        </div>
                                        <div class="form_group">
                                            <label class="form_label" for="subject">Subject</label>
                                            <input class="form_response" type="text" id="subject" name="subject" value="' . getArrayVal($form_data, "subject") . '">
                                            <span class="error">* ' . getArrayVal($errors, "subject") . '</span>
                                        </div>
                                    </div>
                    <!----------------------------------------------------------------------------- 
                    Communication preference section. -------------------------------------------->
                                    <div class="form_group">
                                        <label id="comm_pref" class="form_label" for="comm_pref">Communication preference:</label>
                                        <span class="error">* ' . getArrayVal($errors, "comm_pref") . '</span>
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
                                            <textarea class="form_response" name="message" id="form_response_msg" cols="30" rows="10" value="' . getArrayVal($form_data, "message") . '"></textarea>
                                            <span class="error">* ' . getArrayVal($errors, "message") . '</span>
                                        </div>
                                    </div>
                    <!----------------------------------------------------------------------------- 
                    Submit button. --------------------------------------------------------------->
                                    <input class="form_submit_btn" type="submit" value="Submit">
                                </form>';
    }

    /*************************************************************************
    *                   Server-side Processing of Form Data                  *
    **************************************************************************/
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        foreach ($_POST as $key => $value) {
            $form_data[$key] = cleanData($_POST[$key]);
        }
        foreach($form_data as $key => $value) {
            $errors[$key] = validateData($key, $value);
        }
    }
    ?>
<!----------------------------------------------------------------------------- 
Form starts here. ------------------------------------------------------------>
        <div class="form_container">
            <h2>Contact Me</h2>
        <?php 
        if (!isEmpty($form_data) && isEmpty($errors)) { 
            thankYou($form_data);
         } else { ?>
            <form action="contact.php" method="POST">
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
            </form>  
<?php } 
