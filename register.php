<?php
    require_once "include/functions.php";
    $db = new functions;

    //json response array
    $response = array("error" => FALSE);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && !empty($_POST['name']) && !empty($_POST['email'])
           && !empty($_POST['password']) && !empty($_POST['confirm_password'])){
            

            //receiving the POST parameters
            $name = $db->sanitizeString($_POST['name']);  //Sanitizing the string 
            $email = $db->sanitizeString($_POST['email']);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            
            //check if password is equal to confirm_password to continue
            
            if($db->passwordsMatch($password, $confirm_password)){

            //check whether user exists with the same validated email
               if($db->userExist($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
               
                   //user exists already
                   $response["error"]= TRUE;
                   $response["error_msg"]= "User already exists with email". $email;
                   echo json_encode($response);
               }
               else if(!($db->userExist($email)) && filter_var($email, FILTER_VALIDATE_EMAIL)){
               
                   //user does not exist
                   $user= $db-> storeUser($name, $email, $password);
                   if($user){
                      
                      $hash= bin2hex(openssl_random_pseudo_bytes(70));
                      //new user 
                      $response["error"]= FALSE;
                      $response["uid"]= $user["unique_id"];
                      $response["user"]["name"]= $user["name"];
                      $response["user"]["email"]= $user["email"];
                      $response["user"]["created_at"]= $user["created_at"];
                      $response["user"]["updated_at"]= $user["updated_at"];
                      echo json_encode($response);
                      $db->sendEmail($email, $hash);
                      
                   }
                   else{
                   
                      //user failed to store 
                      $response["error"]= TRUE;
                      $response["error_msg"]= "Unknown error occurred in registration";
                      echo json_encode($response);
                   }                 
               }
               else{
                  
                  //email address is not valid
                  $response["error"]= TRUE;
                  $response["error_msg"]= "Invalid email address ".$email;
                  echo json_encode($response);
               }
           }
           
           //password and confirm password do not match
           else{
              $response["error"]= TRUE;
              $response["error_msg"]= "Password and Confirm password mismatch";
              echo json_encode($response);
           }
       }
       
       //Some parameters may be missing in the form being submitted
       else{
          $response["error"]= TRUE;
          $response["error_msg"]= "Required parameters are missing";
          echo json_encode($response);
       }
   }
?>
