<?php 
class Message
{
    private $username;
    private $message;
    private $date;
    private $errors = [];

    public function __construct(string $username, string $message, ?DateTime $date = null )
    {
        $this->username = htmlspecialchars($username);
        $this->message = htmlspecialchars($message);
        $this->date = $date;
    }

    private function isValidElement(string $name,string $element, string $error_msg, int $limit = 3)
    {
        if (strlen($element) < $limit) {
            $this->errors += [ $name => $error_msg ];
            return false;
        }else{
            return true;
        }
    }

    public function isValid()
    {
        $verif1 = self::isValidElement('username', $this->username, "Entrer au minimum 3 caracteres", 3); 
        $verif2 = self::isValidElement('message', $this->message, "Entrer au minimum 10 caracteres", 10); 
        return( $verif1 && $verif2);
    }

    public function getErrors(): array{ return $this->errors; }

    public function toJson()
    {
        return json_encode([
            'username' => $this->username,
            'message' => $this->message,
            'date' => ($this->date->getTimestamp())
        ]);
    }

    public function toHTML(): string
    {
        if (!empty($this->username) && !empty($this->message)) {
            return "<p><strong>$this->username</strong> <em>le ". $this->date->format("Y-m-d") ." a ". $this->date->format("H:i:s") ." </em><br> $this->message </p>";
        }
        return "";
    }

    public static function fromJSON(string $message_json)
    {
        $message = (array)json_decode($message_json);
        return $message;    
    }

}