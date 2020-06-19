<?php
namespace App\Controllers\frontend;

use App\Controllers\Controller;
use Respect\Validation\Validator;
use App\Models\User;
use PHPMailer\PHPMailer\PHPMailer;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function getIndex()
    {
        $this->view("frontend/home");
    
    }

    public function getlogin()
    {
        $this->view('frontend/login');
    }

    public function getregister()
    {
        $this->view('frontend/register');
    }

    public function postregister()
    {
        // var_dump($_REQUEST);
        $validator = new Validator();
        $errors = [];
        $username       = $_POST['username'];
        $email          = $_POST['email'];
        $password       = $_POST['password'];
        $profile_photo  = $_FILES['profile_photo'];
        if ($validator::alnum()->noWhitespace()->validate($username) === false) {
            $errors['username'] = 'Username can only contain alphabets or numeric';
        }
        if (\strlen($username) < 6) {
            $errors['username'] = 'Username must have at least 6 chars';
        }
        if ($validator::email()->validate($email) === false) {
            $errors['email'] = 'Email must be a valid email address';
        }
        if (\strlen($password) < 6) {
            $errors['password'] = 'Password must have at least 6 chars';
        }
        if ($validator::image()->validate($profile_photo['name'])) {
            $errors['profile_photo'] = 'Profile photo must be an image file';
        }
        
        // $token = sha1($username.$email.uniqid('llc', true));

        if (empty($errors)) {
            // process file upload
            $file_name = 'profile_photo_'.time();
            $extension = explode('.', $profile_photo['name']);
            $ext = end($extension);
            move_uploaded_file($profile_photo['tmp_name'], 'media/profile_photo/'.$file_name.'.'.$ext);
            $token = sha1($username.$email.uniqid('lipaly', true));

            User::create([
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'profile_photo' => $file_name.'.'.$ext,
                'email_verification_token' => $token,
            ]);

            // send the email
            $mail = new PHPMailer(true);                      // Passing `true` enables exceptions
            try {
                // Server settings
                $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'sudiptashil990@gmail.com';                 // SMTP username
                $mail->Password = 'sudiptakumarshil';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                 // TCP port to connect to
                //Recipients
                $mail->setFrom('sudiptashil990@gmail.com', 'System User');
                $mail->addAddress($email, $username);
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Registration successful';
                $mail->Body = 'Dear '.$username.', <br/>
            Please click the following link to activate your account<br/>
            <a href="http://localhost/phpmaster/activate/'.$token.'">Click Here to Activate</a>
            <br/>- lipaly framework';
                $mail->send();
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
            // end send the email

            $_SESSION['message'] = "user created successfully!!";
            // \header('Location:login');
            }

        $_SESSION['errors'] =  $errors;
        \header('Location:register');



    }

    public function getproduct()
    {
        $this->view('frontend/product');
    }

    public function getactivate($token = '')
    {
        // echo $_GET['token'];
        // echo $token;
        $errors = [];
        if(empty($token))
        {   
            $errors[] = "invalid token";
            $_SESSION['errors'] = $errors;
            \header('Location:register');
            exit();
        }

        $user = User::where('email_verification_token',$token)->first();
        if($user){
            $user->update([
                'email_verified_at' => Carbon::now(),
                'email_verification_token' => null,
            ]);

            $_SESSION['message'] =  'account activated successfully!!';
            \header('Location:login');
            exit();

            }
        // $_SESSION['errors'] =  'invalid token';
        // \header('Location:register');
        // exit();
        // echo '</pre>';
        // var_dump($user);
        // exit();
    }
    
}
