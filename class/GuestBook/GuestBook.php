<?php 
namespace App\GuestBook;

class GuestBook 
{
    private $file;

    public function __construct(string $file)
    {
        if (!empty($file)) {
            $this->file = $file;
        }
    }

    public function addMessage(Message $message)
    {
        try {
            file_put_contents($this->file, $message->toJson() . "\n", FILE_APPEND);
            return true;
        } catch (\Exception $e) {
            //throw $th;
            return "Erreur :" . $e->getMessage();
        }
    }

    public function getMessages(): array
    {
        $messages = file($this->file);
        return $messages;
    }
}

