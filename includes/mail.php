<?php isset( $porto_is_allowed ) ? false : die( "You do not have authorization to view this page." ); ?>

<?php

$email_address; 
$message;

if ( isset( $_POST[ 'submit-modal' ] ) || isset( $_POST[ 'submit-footer' ] ) ) {

    if ( isset( $_POST[ 'email-modal' ] ) && isset( $_POST[ 'message-footer' ] ) ) {

      $email_address = $_POST[ 'email-modal' ];
      $message = $_POST[ 'message-modal' ];

    } 

    else if ( isset( $_POST[ 'email-footer' ] ) || isset( $_POST[ 'message-footer' ] ) ) {

      $email_address = $_POST[ 'email-footer' ];
      $message = $_POST[ 'message-footer' ];

    }

    else {

      $_SESSION[ 'message-sent' ] = false;
      header( "Location: message-error.php" );

    }

    try {

      $email = new PortfolioEmail( $email_address, $message );
      $email->send_email_to_brandon();

      $_SESSION[ 'message-sent' ] = true;

      header( "Location: message-sent.php" );

    }

    catch( PortfolioEmailException $ex ) {

        $_SESSION[ 'message-sent' ] = false;
        header( "Location: message-error.php" );

    }


}

class PortfolioEmail {

    private $host_email = "me@brandongiampa.com";
    private $user_email;
    private $subject_to_host = "Dev Inquiry";
    private $subject_to_user = "Thanks for Reaching Out!";
    private $msg_from_user;
    private $msg_from_host = "Brandon has received your email and shall reply as soon as he can.<br>Have a good one!";
    private $headers;

    public function __construct( $user_email, $msg_from_user ) {

        if ( $user_email === "" || $user_email === null ) {

            throw new PortfolioEmailException( "Email field cannot be left blank." );
            return;

        }

        if ( $msg_from_user === "" || $msg_from_user === null ) {

            throw new PortfolioEmailException( "Message field cannot be left blank." );
            return;

        }

        if ( !filter_var( $user_email, FILTER_VALIDATE_EMAIL ) ) {

            throw new PortfolioEmailException( "Please input valid email address." );
            return;

        }

        $this->user_email = $user_email;
        $this->msg_from_user = htmlspecialchars( $msg_from_user );
        $this->headers = "From: " . $user_email . "\r\n";

    }

    public function send_email_to_brandon() {

        if ( ! mail( $this->user_email, $this->subject_to_user, $this->msg_from_host, $this->headers ) ) {

            throw new PortfolioEmailException( "Unfortunately, there was an error transmitting your email. Please try again." );
            return;

        }

        $this->send_confirmation_email_to_user();

    }

    public function send_confirmation_email_to_user() {

        if ( ! mail( $this->host_email, $this->subject_to_host, $this->msg_from_user, $this->headers ) ) {

            throw new PortfolioEmailException( "Unfortunately, there was an error transmitting your email. Please try again." );
            return;

        }

    }

}

class PortfolioEmailException extends Exception {

    // Redefine the exception so message isn't optional
    public function __construct( $message, $code = 0, Throwable $previous = null ) {

      // make sure everything is assigned properly
      parent::__construct( $message, $code, $previous );

    }

    // custom string representation of object
    public function __toString() {

      return __CLASS__ . ": [{$this->code}]: {$this->message}\n";

    }

}

?>
