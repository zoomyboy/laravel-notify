<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class CustomMailMessage extends MailMessage {

	public $subbuttons = [];
	public $elements = [];
	public $subcopy = '';

	use DisplaysFieldLinks;

    /**
     * Get an array representation of the message.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'level' => $this->level,
            'subject' => $this->subject,
            'greeting' => $this->greeting,
            'salutation' => $this->salutation,
			'elements' => $this->elements,
			'subcopy' => $this->subcopy
        ];
	}

	public function btnSuccess($action, $url) {
		$this->elements[] = ['type' => 'button', 'url' => $url, 'color' => 'green', 'action' => $action];
		return $this;
	}

	public function btnWarning($action, $url) {
		$this->elements[] = ['type' => 'button', 'url' => $url, 'color' => 'yellow', 'action' => $action];
		return $this;
	}

	public function btnDanger($action, $url) {
		$this->elements[] = ['type' => 'button', 'url' => $url, 'color' => 'red', 'action' => $action];
		return $this;
	}

	public function buttonline($callable) {
		$buttons = [];
		$line = new Line();
		call_user_func_array($callable, array(&$line));
		$this->elements[] = ['type' => 'row', 'elements' => $line->elements];
	}

	public function line($text) {
		$this->elements[] = ['type' => 'line', 'content' => $text];
		return $this;
	}

	public function action($text, $url) {
		$this->elements[] = ['type' => 'action', 'url' => $url, 'content' => $text, 'color' => 'green'];
		return $this;
	}

	public function subcopy($subcopy) {
		$this->subcopy = $subcopy;
		return $this;
	}

	public function salutation($salutation) {
		$this->salutation = $salutation;

		return $this;
	}
}
