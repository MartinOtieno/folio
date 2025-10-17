<?php
/**
 * PHP Email Form
 * A simple reusable PHP mail handler for forms
 */

class PHP_Email_Form {
  public $to = '';
  public $from_name = '';
  public $from_email = '';
  public $subject = '';
  public $ajax = false;
  private $messages = array();

  public function add_message($content, $label = '', $priority = 0) {
    $this->messages[] = array('content' => $content, 'label' => $label, 'priority' => $priority);
  }

  public function send() {
    if(empty($this->to) || empty($this->from_email) || empty($this->subject)) {
      return 'Please fill in all required fields.';
    }

    $message = '';
    foreach ($this->messages as $msg) {
      $message .= ($msg['label'] ? $msg['label'] . ": " : '') . $msg['content'] . "\n";
    }

    $headers = "From: {$this->from_name} <{$this->from_email}>\r\n";
    $headers .= "Reply-To: {$this->from_email}\r\n";

    if (mail($this->to, $this->subject, $message, $headers)) {
      return 'OK';
    } else {
      return 'Email sending failed. Check your server mail configuration.';
    }
  }
}
?>
