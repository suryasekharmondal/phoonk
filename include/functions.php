<?php
    class functions{
        
        private $conn;

        //constructor for connecting to the database

        function __construct(){
            require_once "include/connect.php";
            $db= new connect;  //instance of the class connect
            $this->conn= $db->db_connect();  //connecting to the databse using $conn
        }

        //destructor

        function __destruct(){
            
        }

        /*Get user by email and password*/

        public function getUserByEmailAndPassword($email, $password){
            $stmt= $this->conn->prepare("select email from users where email= ?");
            $stmt->bind_param("s", $email);

            if($stmt->execute()){
                $user= $stmt->get_result()->fetch_assoc();
                $stmt->close();
                return $user;
            }
            else{
                return NULL;
            }
        }

        /*Store details of new user*/

        public function storeUser($name,$email,$password){
            $uid= uniqid('',true); //generates a 23-character long id which is unique, NOT to be used for security purposes
            $hash= $this->hashSSHA($password);
            $encrypted_password= $hash["encrypted"];
            $salt= $hash["salt"];

            $stmt= $this->conn->prepare("insert into users(unique_id,name,email,encrypted_password,salt,created_at) values(?,?,?,?,?,NOW())");
            $stmt->bind_param("sssss",$uid,$name,$email,$encrypted_password,$salt);
            $result= $stmt->execute();
            $stmt->close();

            //check for successful store
            if($result){
                $stmt= $this->conn->prepare("select * from users where email= ?");
                $stmt->bind_param("s",$email);
                $stmt->execute();
                $user= $stmt->get_result()->fetch_assoc();

                return $user;
            }
            else{
                return false;
            }
        }

        /*Encrypting password, returns salt and encrypted password*/

        public function hashSSHA($password){
            $salt= sha1(rand()); //generate a random number and find the sha1 of the number which is a 160 bit output, false by default
            $salt= substr($salt,0,10);
            $encrypted= base64_encode(sha1($password.$salt, true).$salt); //encoded to make binary data survive through transport layers
            $hash= array("salt"=>$salt, "encrypted"=>$encrypted);
            return $hash;
        }

        /*Check whether user exists or not*/

        public function userExist($email){
            $stmt = $this->conn->prepare("select email from users where email= ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result(); 
            if($stmt->num_rows>0){
                $stmt->close();
                return TRUE;
            }
            else{
                $stmt->close();
                return FALSE;
            }

        }

        /*Decrypt password*/
        public function checkhashSSHA($salt, $password){
            $hash= base64_encode(sha1($password.$salt, true).$salt);
            return $hash;
        }

        /*Sanitizing the string of initial and end spaces as well as speacial characters and html tags*/
        public function sanitizeString($string){
            $sanitized_string = htmlentities(mysqli_real_escape_string($this->conn, trim($string)));
            return $sanitized_string;
        }

        /*To check if password and confirm passwords match*/
        public function passwordsMatch($password, $confirm_password){
            if($password!=$confirm_password){
                return FALSE;
            }
            return TRUE;
        }

        //Send a verification email to the new user
        public function sendEmail($recipient, $hash){

            require "PHPMailer-master/PHPMailerAutoload.php";
            $mail= new PHPMailer;

            $mail->isSMTP();
            $mail->SMTPAuth= TRUE;
            $mail->Host= "ssl://smtp.gmail.com";
            $mail->Port= 465;
            $mail->Username= "suryasekhar.mondal@gmail.com";
            $mail->Password= "smtp13";
            $webmaster_email= "noreply@phoonk.in";
            $email= $recipient;
            $mail->From= $webmaster_email;
            $mail->AddAddress($email);
            $mail->Subject= "Signup|Verification";
            $mail->Body= 'Thanks for signing up!
                       Please click here in the link to activate your account:
                       http://www.phoonk.in/verify/'.$hash;
            if(!$mail->send()) echo "Mailer Error: " . $mail->ErrorInfo;
            else  echo "Message has been sent";

        }
    }
    
?>
