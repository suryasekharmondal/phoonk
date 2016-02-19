<?php
   require_once "include/functions.php";
   $db= new functions;
   
   //json response array
   $response= array("error"=> FALSE);
   
   if($_SERVER['REQUEST_METHOD'] === 'POST'){
      if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])){
      
         //receiving the post parameters
         $email= $db->sanitizeString($_POST['email']);
         $password= $_POST['password'];
         
         if(filter_var($email, FILTER_VALIDATE_EMAIL)){ //chcking for email validation
            
            $user= $db->getUserByEmailAndPassword($email, $password);
            if($user){
               
               //user found
               $response["error"]= FALSE;
               $response["uid"]= user["unique_id"];
               $response["user"]["name"]= $user["name"];
               $response["user"]["email"]= $user["email"];
               $response["user"]["created_at"]= $user["created_at"];
               $response["user"]["updated_at"]= $user["updated_at"];
               echo json_encode($response);
            }
            else{
               
               //Login credentials are wrong
               $response["error"]= TRUE;
               $response["error_msg"]= "Login credentials are wrong! Try again";
               echo json_encode($response);
            }
         }
         
         else{
            
            //Email address may not be valid
            $response["error"]= TRUE;
            $response["error_msg"]= "Email address". $email. "is invalid";
            echo json_encode($response);
         }      
      }
      
      else{
      
         //Some parameters may be missing
         $response["error"]= TRUE;
         $response["error_msg"]= "Required parameters(email, password) may be missing";
         echo json_encode($response);
      }
   }
?>
